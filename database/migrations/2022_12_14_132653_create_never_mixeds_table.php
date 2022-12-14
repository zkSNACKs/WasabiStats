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
        Schema::create('never_mixeds', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->double("wasabi")->defalult(0);
            $table->double("wasabi2")->defalult(0);
            $table->double("samuri")->defalult(0);
            $table->double("otheri")->defalult(0);
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
        Schema::dropIfExists('never_mixeds');
    }
};
