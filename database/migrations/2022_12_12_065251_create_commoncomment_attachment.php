<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommoncommentAttachment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsupport_ticket_cmncomment_attachment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ticket_id');
            $table->integer('comment_id');
            $table->string('attachment', 500);
            $table->timestamps();
            $table->tinyInteger('del_flag')->default(1);
            $table->string('add_ip_addrs', 500)->nullable();
            $table->string('edit_ip_addrs', 500)->nullable();
            $table->integer('add_admin_id')->nullable();
            $table->integer('edit_admin_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qsupport_ticket_cmncomment_attachment');
    }
}
