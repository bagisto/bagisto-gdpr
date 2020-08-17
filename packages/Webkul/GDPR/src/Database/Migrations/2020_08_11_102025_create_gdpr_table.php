<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGdprTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gdpr', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('gdpr_status');
            $table->boolean('customer_agreement_status');
            $table->string('agreement_label')->nullable();
            $table->longText('agreement_content')->nullable();
            $table->boolean('cookie_status');
            $table->string('cookie_block_position');
            $table->string('cookie_static_block_identifier')->nullable();
            $table->string('data_update_request_template')->nullable();
            $table->string('data_delete_request_template')->nullable();
            $table->string('request_status_update_template')->nullable();
            $table->string('request_status_delete_template')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gdpr');
    }
}
