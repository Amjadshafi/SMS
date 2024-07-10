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
        Schema::table('complaint_files', function (Blueprint $table) {
            $table->tinyInteger('of_the_accused')->default(0)->comment("0-> complainant's file, 1 -> accused's file");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaint_files', function (Blueprint $table) {
            $table->dropColumn('of_the_accused');
        });
    }
};
