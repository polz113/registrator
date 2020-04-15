<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_assignments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreign('h_r_master_update_id')->constrained()->onDelete('cascade');
            $table->string('grouptype');
            $table->string('orig_group');
            $table->string('group');
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
        Schema::dropIfExists('group_assignments');
    }
}