<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class DelegationsModel extends Model
{
    protected $table    = 'qsupport_ticket_delegations';
    protected $fillable = [
        'assignment_id', 'ticket_id', 'assigned_to', 'assigned_by', 'assigned_date', 'ticket_status', 'delegation_comments', 
        'close_comments', 'add_ip_addrs', 'ticketclosed_date', 'edit_ip_addrs'
    ];
}
