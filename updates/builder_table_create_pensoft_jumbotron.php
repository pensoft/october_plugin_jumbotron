<?php namespace Pensoft\Jumbotron\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePensoftJumbotron extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pensoft_jumbotron')) {
            Schema::create('pensoft_jumbotron', function(Blueprint $table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('title');
                $table->string('slug');
                $table->text('body');
                $table->string('button_name');
                $table->string('url');
                $table->string('url_target');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pensoft_jumbotron')) {
            Schema::dropIfExists('pensoft_jumbotron');
        }
    }
}