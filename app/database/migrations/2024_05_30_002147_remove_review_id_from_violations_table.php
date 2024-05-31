<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveReviewIdFromViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('violations', function (Blueprint $table) {
                $table->dropColumn('review_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('violations', function (Blueprint $table) {
            $table->unsignedBigInteger('review_id')->nullable();
        });
    }
}
