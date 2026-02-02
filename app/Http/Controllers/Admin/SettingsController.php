<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Show settings form
     */
    public function index()
    {
        $settings = SiteSetting::getAllGrouped();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show color settings
     */
    public function colors()
    {
        $colors = SiteSetting::getByCategory('colors');
        // Convert values from ['key' => ['value' => ...]] to ['key' => value]
        $colors = collect($colors)->mapWithKeys(fn($item, $key) => [$key => is_array($item['value']) ? json_encode($item['value'], JSON_UNESCAPED_UNICODE) : $item['value']])->toArray();
        return view('admin.settings.colors', compact('colors'));
    }

    /**
     * Update color settings
     */
    public function updateColors(Request $request)
    {
        $validated = $request->validate([
            'primary_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'secondary_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'accent_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'dark_color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, null, 'color', 'colors');
        }

        return redirect()->back()->with('success', 'تم تحديث الألوان بنجاح');
    }

    /**
     * Show social links settings
     */
    public function social()
    {
        $social = SiteSetting::getByCategory('social');
        $social = collect($social)->mapWithKeys(fn($item, $key) => [$key => is_array($item['value']) ? json_encode($item['value'], JSON_UNESCAPED_UNICODE) : $item['value']])->toArray();
        return view('admin.settings.social', compact('social'));
    }

    /**
     * Update social links
     */
    public function updateSocial(Request $request)
    {
        $validated = $request->validate([
            'facebook_url' => 'required|url',
            'twitter_url' => 'required|url',
            'instagram_url' => 'required|url',
            'linkedin_url' => 'required|url',
            'youtube_url' => 'nullable|url',
            'whatsapp_number' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            if ($value) {
                SiteSetting::set($key, $value, null, 'url', 'social');
            }
        }

        return redirect()->back()->with('success', 'تم تحديث روابط التواصل بنجاح');
    }

    /**
     * Show organization info settings
     */
    public function organization()
    {
        $organization = SiteSetting::getByCategory('general');
        $organization = collect($organization)->mapWithKeys(fn($item, $key) => [$key => is_array($item['value']) ? json_encode($item['value'], JSON_UNESCAPED_UNICODE) : $item['value']])->toArray();
        return view('admin.settings.organization', compact('organization'));
    }

    /**
     * Update organization info
     */
    public function updateOrganization(Request $request)
    {
        $validated = $request->validate([
            'organization_name' => 'required|string|max:255',
            'organization_email' => 'required|email',
            'organization_phone' => 'required|string|max:20',
            'organization_address' => 'required|string|max:255',
            'organization_description' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            $type = $key === 'organization_email' ? 'email' : 'text';
            if ($key === 'organization_description') {
                $type = 'textarea';
            }
            SiteSetting::set($key, $value, null, $type, 'general');
        }

        return redirect()->back()->with('success', 'تم تحديث معلومات المؤسسة بنجاح');
    }

    /**
     * Show content settings
     */
    public function content()
    {
        $content = SiteSetting::getByCategory('content');
        $content = collect($content)->mapWithKeys(fn($item, $key) => [$key => is_array($item['value']) ? json_encode($item['value'], JSON_UNESCAPED_UNICODE) : $item['value']])->toArray();
        return view('admin.settings.content', compact('content'));
    }

    /**
     * Update content settings
     */
    public function updateContent(Request $request)
    {
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'footer_description' => 'required|string',
        ]);

        foreach ($validated as $key => $value) {
            SiteSetting::set($key, $value, null, 'textarea', 'content');
        }

        return redirect()->back()->with('success', 'تم تحديث النصوص بنجاح');
    }
}
