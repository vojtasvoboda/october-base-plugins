<?php namespace Site\Events\Updates;

use DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('site_events_events', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 300);
            $table->string('slug', 255)->unique();
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->string('youtube_video_code', 50)->nullable();
            $table->text('description')->nullable();
            $table->boolean('enabled')->default(true);
            $table->boolean('top')->default(false);
            $table->smallInteger('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_events_events');
    }
}
