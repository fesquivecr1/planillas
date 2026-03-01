<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    public function edit()
    {
        $setting = CompanySetting::first();

        return view('configuration.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = CompanySetting::first();

        $request->validate([
            'ccss_employee_percentage' => 'required|numeric|min:0|max:100',
            'ccss_employer_percentage' => 'required|numeric|min:0|max:100',
        ]);
        //  dd($request->all());
        $setting->update($request->all());

        return back()->with('success', 'Configuración actualizada correctamente');
    }
}
