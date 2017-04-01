<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('blogs') ) {
            Schema::create('blogs', function (Blueprint $table) {
                $table->bigIncrements('id');
            });
        }

        Schema::table('blogs', function (Blueprint $table) {

            if (!Schema::hasColumn($table->getTable(), 'title')) {
                $table->string('title', 191);
            }

            if (!Schema::hasColumn($table->getTable(), 'body')) {
                $table->text('body');
            }

            if ( ! Schema::hasColumn($table->getTable(), 'created_at') ) {
                $table->dateTime('created_at');
            }

            if ( ! Schema::hasColumn($table->getTable(), 'updated_at') ) {
                $table->timestamp('updated_at');
            }

            if ( ! Schema::hasColumn($table->getTable(), 'deleted_at') ) {
                $table->dateTime('deleted_at')->nullable();
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('blogs');
    }
}
