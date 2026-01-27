<?php

namespace App\Support;

use DOMDocument;

class HtmlSanitizer
{
    public static function clean(?string $html): string
    {
        if ($html === null || $html === '') {
            return '';
        }

        $allowedTags = [
            'p', 'br', 'strong', 'em', 'u', 'ul', 'ol', 'li',
            'h1', 'h2', 'h3', 'blockquote', 'a',
        ];

        $doc = new DOMDocument();
        $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $nodes = $doc->getElementsByTagName('*');
        for ($i = $nodes->length - 1; $i >= 0; $i--) {
            $node = $nodes->item($i);
            if (!in_array($node->nodeName, $allowedTags, true)) {
                $node->parentNode?->removeChild($node);
                continue;
            }

            if ($node->nodeName === 'a') {
                $href = $node->getAttribute('href');
                if ($href && !preg_match('/^(https?:\/\/|\/)/i', $href)) {
                    $node->removeAttribute('href');
                }
                $node->setAttribute('rel', 'noopener');
                $node->setAttribute('target', '_blank');
            } else {
                while ($node->attributes->length) {
                    $node->removeAttributeNode($node->attributes->item(0));
                }
            }
        }

        return $doc->saveHTML();
    }
}
