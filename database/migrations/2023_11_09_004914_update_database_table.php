<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transaction', function (Blueprint $table) {
            // Drop the existing fields
            $table->dropColumn('is_pending');
            $table->dropColumn('is_acknowledged');
            $table->dropColumn('is_ordered');

            // Add the new 'status' field as ENUM
            $table->enum('status', ['acknowledged', 'pending', 'ordered']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('organization', 64);
        });
    }

    public function down()
    {
        Schema::table('transaction', function (Blueprint $table) {
            // Reverse the changes in the 'down' method if needed
            $table->dropColumn('status');
            $table->boolean('is_pending');
            $table->boolean('is_acknowledged');
            $table->boolean('is_ordered');
        });

        Schema::table('location', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
        });
    }
};
