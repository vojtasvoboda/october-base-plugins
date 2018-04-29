<?php namespace Site\Team\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateMembersTable extends Migration
{
    public function up()
    {
        Schema::create('site_team_members', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 300);
            $table->string('position', 300)->nullable();
            $table->string('linkedin', 300)->nullable();
            $table->string('mail', 300)->nullable();
            $table->boolean('enabled')->default(true);
            $table->smallInteger('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('site_team_members');
    }
}
