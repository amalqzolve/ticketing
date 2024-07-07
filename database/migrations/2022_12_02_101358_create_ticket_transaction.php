<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ticket_id');
            $table->integer('assigned_to');
            $table->integer('assigned_by');
            $table->text('transfer_comment');
            $table->timestamps();
            $table->string('add_ip_addrs', 500)->nullable();
            $table->string('edit_ip_addrs', 500)->nullable();
            $table->tinyInteger('del_flag')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_transaction');
    }
}
