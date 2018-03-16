<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jokes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('icon_url', 255);
            $table->text('value');
            $table->string('slug', 100)->nullable();
            $table->integer('isVisited')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                  ->on('users')
                  ->references('id')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });

        $createTrigger = <<<EOT
CREATE TRIGGER add_slug_to_jokes_bi BEFORE INSERT ON `jokes` FOR
EACH ROW
  BEGIN
    set new.slug = md5(CONCAT(new.icon_url, new.value, new.created_at));
  END
EOT;

DB::unprepared($createTrigger);

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 80)->unique();
        });

        Schema::create('jokes_categories', function (Blueprint $table) {
            $table->integer('joke_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->primary(['joke_id', 'category_id']);

            $table->foreign('joke_id')
                  ->on('jokes')
                  ->references('id')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('category_id')
            ->on('categories')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40)->unique();
        });

        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action', 40)->unique();
            $table->string('url', 200);
            $table->boolean('isMenu');
        });

        Schema::create('users_roles', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->primary(['user_id', 'role_id']);

            $table->foreign('user_id')
                  ->on('users')
                  ->references('id')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('role_id')
            ->on('roles')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::create('roles_actions', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('action_id')->unsigned();
            $table->primary(['role_id', 'action_id']);

            $table->foreign('role_id')
                  ->on('roles')
                  ->references('id')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('action_id')
            ->on('actions')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_actions');
        Schema::dropIfExists('users_roles');
        Schema::dropIfExists('jokes_categories');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('actions');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('jokes');
        Schema::dropIfExists('users');
    }
}
