<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class TicketactivitylogModel extends Model
{
    protected $table    = 'qsupport_ticket_activitylog';
    protected $fillable = [
        'subject_id', 'subject', 'ticket_id', 'activity_type', 'activity','user_id','add_ip_addrs'
    ];
}
