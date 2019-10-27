<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('object_domain');
            $table->string('object_id');
            $table->string('task_id');
            $table->string('description')->default(null);
            $table->boolean('is_completed')->default(false);
            $table->timestamp('due')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('urgency')->default(null);
            $table->timestamp('completed_at')->default(null);
            $table->integer('last_update_by')->default(null);
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checklist');
    }
}
