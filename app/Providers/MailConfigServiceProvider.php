<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // if (\Schema::hasTable('qcrm_emailsettings')) {
        //     $mail = DB::table('qcrm_emailsettings')->first();
        //     if ($mail) //checking if table is not empty
        //     {
        //         $config = array(
        //             'driver'     => $mail->driver, //'smtp',
        //             'host'       => $mail->host,
        //             'port'       => $mail->port_no,
        //             'from'       => array('address' => $mail->sender_email, 'name' => 'Qzolve ERP'),
        //             'encryption' => 'tls',
        //             'username'   => $mail->username,
        //             'password'   => $mail->passwrd,
        //             'sendmail'   => '/usr/sbin/sendmail -bs',
        //             'pretend'    => false,

        //         );
        //         Config::set('mail', $config);
        //     }
        // } else {
        //    // echo "mail table not configured ";
        // }
    }
}
