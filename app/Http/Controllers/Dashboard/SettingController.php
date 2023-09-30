<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('settings.view');

        $setting = Setting::first();
        return view('dashboard.settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = Setting::firstOrNew();

        if ($setting->exists) {
            Gate::authorize('settings.update');
        } else {
            Gate::authorize('settings.create');
        }

        $validatedData = $request->validate($this->rules());

        $imagePaths = [];
        foreach (['website_logo', 'epilogue_logo', 'tab_logo', 'qr_code', 'invoice_stamp'] as $field) {
            if ($request->hasFile($field)) {
                if ($setting->$field && Storage::disk('public')->exists($setting->$field)) {
                    Storage::disk('public')->delete($setting->$field);
                }

                $path = $request->file($field)->store('settings', [
                    'disk' => 'public',
                ]);
                $imagePaths[$field] = $path;
            }
        }

        $setting->fill(array_merge($validatedData, $imagePaths));
        $setting->save();

        $message = $setting->wasRecentlyCreated ? 'Settings saved successfully!' : 'Settings updated successfully!';

        return redirect()->route('dashboard.setting')->with('success', $message);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'currency' => 'nullable|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tax_number' => 'nullable|string|max:255',
            'website_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'epilogue_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tab_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'invoice_stamp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}