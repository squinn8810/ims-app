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
        Schema::create('transaction', function (Blueprint $table) {
            $table->integer('transNum', true);
            $table->dateTime('transDate');
            $table->integer('itemLocID')->index('transaction_itemlocid_foreign');
            $table->string('employeeID', 32)->index('transaction_employeeid_foreign');
            $table->boolean('is_pending')->default(false);
            $table->boolean('is_acknowledged')->default(false);
            $table->boolean('is_ordered')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
};
