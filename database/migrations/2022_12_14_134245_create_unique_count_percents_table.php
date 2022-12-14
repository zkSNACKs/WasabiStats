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
        Schema::create('unique_count_percents', function (Blueprint $table) {
            $table->id();
            $table->double('unique_out_count');
            $table->double('unique_ln_count');
            $table->double('unique_out_count_percent');
            $table->double('unique_ln_count_percent');
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
        Schema::dropIfExists('unique_count_percents');
    }
};
