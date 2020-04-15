<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOUAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_u_assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreign('h_r_master_update_id')->constrained()->onDelete('cascade');
            $table->string('orig_OU');
            $table->string('OU');
            $table->timestamp('valid_from');
            $table->timestamp('valid_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('o_u_assignments');
    }
}
