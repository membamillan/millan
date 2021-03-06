<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementsByPoliceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
		Schema::create('statements', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('crime_id')->unsigned();
			$table->foreign('crime_id')->references('id')->on('report_crimes');
			$table->integer('admin_id')->unsigned();
			$table->foreign('admin_id')->references('id')->on('admins');
			$table->string('ob_number');
      $table->integer('status');
			$table->string('police_number');
			$table->string('statement');
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
        Schema::dropIfExists('statements');
    }
}
