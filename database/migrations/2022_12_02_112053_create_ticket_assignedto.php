<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use phpDocumentor\Reflection\Types\Integer;

class CreateTicketAssignedto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsupport_ticket_assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ticket_id');
            $table->integer('assigned_to');
            $table->integer('assigned_by');
            $table->tinyInteger('ticket_status')->default(1);
            $table->text('close_comments')->nullable();
            $table->timestamps();
            $table->string('add_ip_addrs', 500)->nullable();
            $table->string('edit_ip_addrs', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_assignedto');
    }
}
