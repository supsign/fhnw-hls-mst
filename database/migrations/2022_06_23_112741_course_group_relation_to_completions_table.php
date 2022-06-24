<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('completions', function (Blueprint $table) {
            $table->foreignId('course_group_id')->after('course_year_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('completions', function (Blueprint $table) {
            $table->dropForeign(['course_group_id']);
            $table->dropColumn('course_group_id');
        });
    }
};
