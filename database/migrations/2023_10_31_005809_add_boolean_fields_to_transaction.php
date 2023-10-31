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
        Schema::table('transaction', function (Blueprint $table) {
            $table->boolean('is_pending')->default(false);
            $table->boolean('is_acknowledged')->default(false);
            $table->boolean('is_ordered')->default(false);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_superuser')->default(false);
        });

        Schema::create('organization', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name', 64);
            $table->string('address', 32);
            $table->string('city', 32);
            $table->string('state', 2);
            $table->string('zip', 5); // Use a string field for ZIP codes
            $table->string('phone', 20);
            $table->string('superuser', 32);
            $table->integer('locID'); // Integer field for locID
            $table->timestamps(); // Created_at and updated_at timestamps
        });

        Schema::table('organization', function (Blueprint $table) {
            $table->foreign('superuser')->references('id')->on('users'); // 'users' is the name of your user table
        });

        Schema::table('organization', function (Blueprint $table) {
            $table->foreign('locID')->references('locID')->on('item_location'); // 'users' is the name of your user table
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction', function (Blueprint $table) {
            //
        });
    }
};
