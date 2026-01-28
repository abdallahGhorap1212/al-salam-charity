<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-terms-and-conditions')->only(['edit']);
        $this->middleware('permission:edit-terms-and-conditions')->only(['update']);
    }

    public function edit()
    {
        $termsAndConditions = TermsAndConditions::firstOrCreate([
            'id' => 1,
        ], [
            'title' => 'الشروط والأحكام',
            'content' => 'يرجى إضافة محتوى الشروط والأحكام هنا',
            'is_active' => true,
        ]);

        return view('admin.terms-and-conditions.edit', compact('termsAndConditions'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'summary' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $termsAndConditions = TermsAndConditions::firstOrFail();
        $termsAndConditions->update($validated);

        return redirect()->back()->with('success', 'تم تحديث الشروط والأحكام بنجاح');
    }
}
