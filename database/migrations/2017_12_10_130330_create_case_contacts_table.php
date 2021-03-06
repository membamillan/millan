<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('court_case_id')->unsigned();
            $table->foreign('court_case_id')->references('id')->on('court_cases');
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');
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
        Schema::dropIfExists('case_contacts');
    }
}
