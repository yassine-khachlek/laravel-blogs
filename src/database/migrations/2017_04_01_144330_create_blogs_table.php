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

            if (!Schema::hasColumn($table->getTable(), 'published')) {
                $table->boolean('published')->default(FALSE);
            }

            if ( ! Schema::hasColumn($table->getTable(), 'created_at') ) {
                $table->timestamp('created_at')->useCurrent();
            }

            if ( ! Schema::hasColumn($table->getTable(), 'updated_at') ) {
                $table->timestamp('updated_at')->useCurrent();
            }

            if ( ! Schema::hasColumn($table->getTable(), 'deleted_at') ) {
                $table->timestamp('deleted_at')->nullable();
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
