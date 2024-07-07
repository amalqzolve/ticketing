<?php

namespace App\support_ticket;

use Illuminate\Database\Eloquent\Model;

class TicketModel extends Model
{
    protected $table    = 'qsupport_ticket_tickets';
    protected $fillable = [
        'ticketID', 'client_id', 'ticket_against', 'ticket_againstname', 'project_id', 'ticket_title', 'ticket_category_id', 
        'ticket_date', 'completion_date', 'scope_of_work', 'priority_id', 'priority_name', 'assigned_status',
        'reference', 'ticket_details', 'add_admin_id', 'add_ip_addrs','edit_ip_addrs', 'ticket_status', 'ticketclosed_date'
    ];
}
