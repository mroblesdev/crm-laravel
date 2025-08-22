<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SettingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:configuracion', only: ['index', 'store']),
        ];
    }
    
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
            'logo' => 'nullable|image|max:255',
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|string|max:255',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['_token', 'logo']);

        foreach ($data as $key => $value) {
            if ($key === 'mail_password' && !empty($value)) {
                $value = encrypt($value);
            } elseif ($key === 'mail_password' && empty($value)) {
                continue;
            }

            Setting::setValue($key, $value);
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('images', 'public');
            Setting::setValue('logo', $path);
        }

        return redirect()->back()->with('success', 'Configuración guardada correctamente');
    }
}
