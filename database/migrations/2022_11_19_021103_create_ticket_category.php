<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsupport_ticket_ticket_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category', 200)->change();
            $table->text('description')->nullable()->change();
            $table->timestamps();
            $table->tinyInteger('del_flag')->default(1)->change();
            $table->string('add_ip_addrs', 200)->change();
            $table->string('edit_ip_addrs', 200)->change();
            $table->integer('add_admin_id');
            $table->integer('edit_admin_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_category');
    }
}
