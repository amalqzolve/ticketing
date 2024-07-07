<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class TicketStatusModel extends Model
{
    protected $table    = 'qsupport_ticket_ticket_status';
    protected $fillable = [
        'status', 'description','add_ip_addrs','edit_ip_addrs'
    ];
}
