<?php namespace Site\References\Updates;

use Illuminate\Support\Facades\DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateReferencesTable extends Migration
{
    public function up()
    {
        Schema::create('site_references_references', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 300);
            $table->string('slug', 255)->unique();
            $table->string('client', 300)->nullable();
            $table->string('location', 300)->nullable();
            $table->text('text')->nullable();
            $table->boolean('top')->default(false);
            $table->boolean('enabled')->default(true);
            $table->smallInteger('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_references_references');
    }
}
