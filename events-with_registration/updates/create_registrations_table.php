<?php namespace Site\Events\Updates;

use DB;
use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('site_events_registrations', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('site_events_events')->onDelete('cascade');
            $table->string('name', 300)->nullable();
            $table->string('surname', 300)->nullable();
            $table->string('company', 300)->nullable();
            $table->string('email', 300)->nullable();
            $table->string('phone', 300)->nullable();
            $table->string('locale', 300)->nullable();
            $table->string('referrer', 600)->nullable();
            $table->string('ip', 300)->nullable();
            $table->string('ip_forwarded', 300)->nullable();
            $table->string('user_agent', 300)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_events_registrations');
    }
}
