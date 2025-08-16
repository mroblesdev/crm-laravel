<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'mail_host' => 'nullable|string',
            'mail_port' => 'nullable|string',
            'mail_username' => 'nullable|string',
            'mail_password' => 'nullable|string',
            'mail_encryption' => 'nullable|string',
        ]);

        $data = $request->except(['_token', 'logo']);

        foreach ($data as $key => $value) {
            // Verificamos si el campo es mail_password y está vacío
            if ($key === 'mail_password' && !empty($value)) {
                // Si no está vacío, encriptamos el valor
                $value = encrypt($value);
            } elseif ($key === 'mail_password' && empty($value)) {
                // Si está vacío, no lo actualizamos
                continue;
            }

            Setting::setValue($key, $value);
        }

        // Manejo de logo
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            Setting::setValue('logo', $path);
        }

        return redirect()->back()->with('success', 'Configuración guardada correctamente.');
    }
}
