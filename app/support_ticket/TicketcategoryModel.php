<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class TicketcategoryModel extends Model
{
    protected $table    = 'qsupport_ticket_ticket_category';
    protected $fillable = [
        'category', 'description','add_ip_addrs','edit_ip_addrs'
    ];
}
