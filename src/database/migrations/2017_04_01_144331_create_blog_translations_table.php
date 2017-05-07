<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ( ! Schema::hasTable('blog_translations') ) {
            Schema::create('blog_translations', function (Blueprint $table) {
                $table->bigIncrements('id');
            });
        }

        Schema::table('blog_translations', function (Blueprint $table) {

            if (!Schema::hasColumn($table->getTable(), 'blog_id')) {
                $table->bigInteger('blog_id')->unsigned();
            }
            
            if (!Schema::hasColumn($table->getTable(), 'language_code')) {
                $table->string('language_code', 2);
            }

            if (!Schema::hasColumn($table->getTable(), 'title')) {
                $table->string('title', 191)->nullable();
            }

            if (!Schema::hasColumn($table->getTable(), 'body')) {
                $table->text('body')->nullable();
            }

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
        // Schema::dropIfExists('blog_translations');
    }
}
