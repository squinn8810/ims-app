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
        Schema::table('item_location', function (Blueprint $table) {
            $table->foreign(['itemNum'], 'item_location_ibfk_1')->references(['itemNum'])->on('item')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['locID'], 'item_location_ibfk_2')->references(['locID'])->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_location', function (Blueprint $table) {
            $table->dropForeign('item_location_ibfk_1');
            $table->dropForeign('item_location_ibfk_2');
        });
    }
};
