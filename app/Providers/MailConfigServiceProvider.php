<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            $settings = Setting::all()->pluck('value', 'key')->toArray();

            // Solo aplicar si hay datos de mail configurados
            if ($settings['mail_host']) {
                config([
                    'mail.mailers.smtp' => [
                        'transport' => 'smtp',
                        'host' => $settings['mail_host'],
                        'port' => $settings['mail_port'],
                        'encryption' => $settings['mail_encryption'],
                        'username' => $settings['mail_username'],
                        'password' => $settings['mail_password']
                            ? Crypt::decrypt($settings['mail_password'])
                            : null,
                    ],
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error al cargar configuración de correo desde DB: ' . $e->getMessage());
        }
    }
}
