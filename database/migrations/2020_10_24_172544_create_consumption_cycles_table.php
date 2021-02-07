<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumptionCyclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumption_cycles', function (Blueprint $table) {
            $table->index('full_name');

            $table->id();
            $table->unsignedInteger('user_id')->default(1);
            $table->string('full_name',191);
            $table->text('mobile')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('year')->default(0);
            $table->unsignedBigInteger('month')->default(0);
            $table->unsignedBigInteger('previous')->default(0);
            $table->unsignedBigInteger('curent')->default(0);
            $table->boolean('label')->default(true);
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
        Schema::dropIfExists('consumption_cycles');
    }
}
