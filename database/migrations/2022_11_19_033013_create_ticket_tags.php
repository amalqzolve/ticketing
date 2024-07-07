<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsupport_ticket_ticket_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag_name', 200);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->tinyInteger('del_flag')->default(1);
            $table->string('add_ip_addrs', 500);
            $table->string('edit_ip_addrs', 500);
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
        Schema::dropIfExists('ticket_tags');
    }
}
