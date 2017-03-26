<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicrosoftAzureJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microsoft_azure_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_id', 155)->unsigned()->unique();
            $table->integer('media_id')->unsigned()->unique();
            $table->string('status', 155);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('microsoft_azure_jobs');
    }
}
