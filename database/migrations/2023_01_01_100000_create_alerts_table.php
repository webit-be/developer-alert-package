<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->text('error_message')->nullable()->default(null);
            $table->text('where_from')->nullable()->default(null);
            $table->text('function')->nullable()->default(null);
            $table->longText('stack_trace')->nullable()->default(null);
            $table->string('status')->nullable()->default("Open");
            $table->integer('is_disabled')->default(0);
            $table->integer('times_throwed')->default(1);
            $table->integer('rate_limit')->default(10);
            $table->timestamp('last_throwed')->nullable()->default(null);
            $table->timestamp('snoozed_until')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerts');
    }
};
