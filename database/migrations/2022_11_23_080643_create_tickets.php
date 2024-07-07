<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsupport_ticket_tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->tinyInteger('ticket_against');
            $table->string('ticket_againstname', 20);
            $table->integer('project_id')->nullable();
            $table->string('ticket_title', 500);
            $table->integer('ticket_category_id');
            $table->date('ticket_date');
            $table->date('completion_date')->nullable();
            $table->string('scope_of_work', 500)->nullable();
            $table->integer('priority_id')->nullable();
            $table->string('priority_name', 20)->nullable();
            $table->integer('assigned_to')->nullable();
            $table->tinyInteger('assigned_status')->nullable();
            $table->date('assigned_date')->nullable();
            $table->string('reference', 500)->nullable();
            $table->text('ticket_details');
            $table->timestamps();
            $table->tinyInteger('del_flag')->default(1);
            $table->string('add_ip_addrs', 500)->nullable();
            $table->string('edit_ip_addrs', 500)->nullable();
            $table->integer('add_admin_id')->nullable();
            $table->integer('edit_admin_id')->nullable();
            $table->tinyInteger('ticket_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
