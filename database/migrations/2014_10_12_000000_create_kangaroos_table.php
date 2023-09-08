<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * CreateKangaroosTable
 *
 * @author Limuel Bassig
 * @since 2023.09.07
 */
class CreateKangaroosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kangaroos', function (Blueprint $table) {
            $table->increments('kangaroo_id');
            $table->string('name')->unique();
            $table->string('nickname')->nullable();
            $table->float('weight', 8, 2);
            $table->float('height', 8, 2);
            $table->enum('gender', ['male', 'female']);
            $table->string('color')->nullable();
            $table->enum('friendliness', ['friendly', 'independent'])->nullable();
            $table->date('birthday');

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
        Schema::dropIfExists('kangaroos');
    }
}
