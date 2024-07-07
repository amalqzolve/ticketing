<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class TickettagsModel extends Model
{
    protected $table    = 'qsupport_ticket_ticket_tags';
    protected $fillable = [
        'tag_name', 'description','add_ip_addrs','edit_ip_addrs'
    ];
}
