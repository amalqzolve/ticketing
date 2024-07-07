<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qsupport_ticket_emailsettings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('host', 250);
            $table->string('username', 500);
            $table->string('passwrd', 500);
            $table->tinyInteger('smtpsecure_status')->comment('1=Yes, 2=No');
            $table->integer('port_no');
            $table->string('sender_email', 500);
            $table->string('receiver_email', 500);
            $table->timestamps();
            $table->string('edit_ip_addrs', 500)->nullable();
            $table->integer('edit_admin_id')->nullable();
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
        Schema::dropIfExists('qsupport_ticket_emailsettings');
    }
}
