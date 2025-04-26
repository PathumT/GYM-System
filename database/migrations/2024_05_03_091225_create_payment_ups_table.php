<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_ups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('admition_no');
            $table->string('period');
            $table->integer('ammount');
            $table->date('payment_date');
            $table->string('payment_no')->nullable();
            $table->dateTime('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_ups', function (Blueprint $table) {
            $table->dropColumn('payment_no');
            $table->dropColumn('payment_no_expires_at');
        });
    }
};
