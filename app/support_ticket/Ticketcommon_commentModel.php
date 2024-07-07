<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class Ticketcommon_commentModel extends Model
{
    protected $table    = 'qsupport_ticket_commoncomments';
    protected $fillable = [
        'ticket_id', 'comment_by','comment','add_ip_addrs','edit_ip_addrs'
    ];
}
