<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('currency')->nullable()->default('usd');
            $table->string('phone');
            $table->string('email');
            $table->string('tax_number')->nullable();
            $table->string('website_logo')->nullable();
            $table->string('epilogue_logo')->nullable();
            $table->string('tab_logo')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('invoice_stamp')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
