<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class EmailSettingsModel extends Model
{
    protected $table    = 'qsupport_ticket_emailsettings';
    protected $fillable = [
        'host', 'username', 'passwrd', 'smtpsecure_status', 'port_no', 'sender_email', 'receiver_email', 'edit_ip_addrs','edit_admin_id'
    ];
}
