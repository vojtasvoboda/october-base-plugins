<?php namespace Site\Galleries\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateGalleriesTable extends Migration
{
    public function up()
    {
        Schema::create('site_galleries_galleries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 300);
            $table->string('url', 300);
            $table->boolean('enabled')->default(true);
            $table->smallInteger('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_galleries_galleries');
    }
}
