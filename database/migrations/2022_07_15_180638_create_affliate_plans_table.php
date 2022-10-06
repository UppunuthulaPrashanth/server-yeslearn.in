<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffliatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affliate_plans', function (Blueprint $table) {
            $table->id();
            $table->Integer('rank');
            $table->String('label');
            $table->text('Description');
            $table->String('rank_amount_type');
            $table->Integer('rank_amount');
            $table->String('direct_commi');
            $table->Integer('partner_commi');
            $table->String("rank_color");
            $table->String("icon")->nullable();
            $table->Integer("status")->default(1);
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
        Schema::dropIfExists('affliate_plans');
    }
}
