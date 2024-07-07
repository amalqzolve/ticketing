<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class TickettypeModel extends Model
{
    protected $table    = 'qsupport_ticket_ticket_type';
    protected $fillable = [
        'type_name', 'description','add_ip_addrs','edit_ip_addrs'
    ];
}
