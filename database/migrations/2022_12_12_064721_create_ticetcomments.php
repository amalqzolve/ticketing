<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicetcomments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsupport_ticket_commoncomments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ticket_id');
            $table->integer('comment_by');
            $table->text('comment');
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
        Schema::dropIfExists('qsupport_ticket_commoncomments');
    }
}
