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
        Schema::create('daily_fresh_bitcoins', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->double("wasabi");
            $table->double("wasabi2");
            $table->double("samuri");
            $table->double("otheri");
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
        Schema::dropIfExists('daily_fresh_bitcoins');
    }
};
