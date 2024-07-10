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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable();

            $table->foreign('assigned_to')->references('id')->on('users');
            $table->foreign('assigned_by')->references('id')->on('users');
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->string('complaint_email');
            $table->string('complaint_phone_no');
            $table->string('complaint_fname');
            $table->string('complaint_lname');
            $table->string('complaint_city');
            $table->string('complaint_country');
            $table->text('complaint_address');
            $table->string('accused_email');
            $table->string('accused_phone_no');
            $table->string('accused_name');
            $table->string('accused_department');
            $table->string('accused_city');
            $table->string('accused_country');
            $table->string('accident_place');
            $table->dateTime('accident_date');
            $table->text('complaint_body');
            $table->tinyInteger('status')->comment('0 => Pending, 1 => In Process, 2 => Cancelled, 3 => Completed')->default(0);
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
        Schema::dropIfExists('complaints');
    }
};
