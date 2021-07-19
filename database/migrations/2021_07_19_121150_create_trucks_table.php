<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('maker', 255);
            $table->string('plate', 20);
            $table->integer('make_year');
            $table->text('mechanic_notices');
            $table->unsignedBigInteger('mechanic_id');
            $table->foreign('mechanic_id')->references('id')->on('mechanics');
            $table->timestamps();
        });
    }

//     id: int(11)
// maker: varchar(255)
// plate: varchar(20)
// make_year: tinyint(4) unsigned
// mechanic_notices: text
// mechanic_id : int(11)


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trucks');
    }
}
