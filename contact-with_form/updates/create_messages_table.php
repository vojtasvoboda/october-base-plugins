<?php namespace Site\Contact\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMessagesTable extends Migration
{
    public $table_name = 'site_contact_messages';

    public function up()
    {
        Schema::create($this->table_name, function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 300)->nullable();
            $table->string('email', 300)->nullable();
            $table->string('phone', 300)->nullable();
            $table->string('company', 300)->nullable();
            $table->text('message')->nullable();
            $table->string('referrer', 600)->nullable();
            $table->string('locale', 300)->nullable();
            $table->string('ip_addr', 300)->nullable();
            $table->string('ip_forwarded', 300)->nullable();
            $table->string('user_agent', 300)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop($this->table_name);
    }
}
