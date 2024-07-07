<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsupport_ticket_activitylog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('subject_id');
            $table->text('activity');
            $table->integer('user_id');
            $table->timestamps();
            $table->string('add_ip_addrs', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qsupport_ticket_activitylog');
    }
}
