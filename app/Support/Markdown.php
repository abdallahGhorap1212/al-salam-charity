<?php

namespace App\Support;

use Illuminate\Support\Str;

class Markdown
{
    public static function render(?string $text): string
    {
        if ($text === null || $text === '') {
            return '';
        }

        $lines = preg_split('/\R/', $text);
        $html = [];
        $inUl = false;
        $inOl = false;

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === '') {
                if ($inUl) {
                    $html[] = '</ul>';
                    $inUl = false;
                }
                if ($inOl) {
                    $html[] = '</ol>';
                    $inOl = false;
                }
                continue;
            }

            if (preg_match('/^(#{1,3})\s+(.+)$/', $trimmed, $matches)) {
                if ($inUl) {
                    $html[] = '</ul>';
                    $inUl = false;
                }
                if ($inOl) {
                    $html[] = '</ol>';
                    $inOl = false;
                }
                $level = strlen($matches[1]);
                $content = self::inline(e($matches[2]));
                $html[] = "<h{$level}>{$content}</h{$level}>";
                continue;
            }

            if (preg_match('/^\d+\.\s+(.+)$/', $trimmed, $matches)) {
                if ($inUl) {
                    $html[] = '</ul>';
                    $inUl = false;
                }
                if (! $inOl) {
                    $html[] = '<ol>';
                    $inOl = true;
                }
                $content = self::inline(e($matches[1]));
                $html[] = "<li>{$content}</li>";
                continue;
            }

            if (preg_match('/^[-*]\s+(.+)$/', $trimmed, $matches)) {
                if ($inOl) {
                    $html[] = '</ol>';
                    $inOl = false;
                }
                if (! $inUl) {
                    $html[] = '<ul>';
                    $inUl = true;
                }
                $content = self::inline(e($matches[1]));
                $html[] = "<li>{$content}</li>";
                continue;
            }

            if ($inUl) {
                $html[] = '</ul>';
                $inUl = false;
            }
            if ($inOl) {
                $html[] = '</ol>';
                $inOl = false;
            }

            $content = self::inline(e($trimmed));
            $html[] = "<p>{$content}</p>";
        }

        if ($inUl) {
            $html[] = '</ul>';
        }
        if ($inOl) {
            $html[] = '</ol>';
        }

        return implode("\n", $html);
    }

    private static function inline(string $text): string
    {
        $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $text);

        $text = preg_replace_callback('/\[(.+?)\]\((.+?)\)/', function ($matches) {
            $label = $matches[1];
            $url = $matches[2];

            if (! Str::startsWith($url, ['http://', 'https://', '/'])) {
                return $label;
            }

            $safeUrl = e($url);
            return '<a href="' . $safeUrl . '" target="_blank" rel="noopener">' . $label . '</a>';
        }, $text);

        return $text;
    }
}
