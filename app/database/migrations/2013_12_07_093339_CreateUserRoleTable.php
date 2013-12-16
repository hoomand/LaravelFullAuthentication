<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRoleTable extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('user_role', function(Blueprint $table)
            {
                    $table->increments('id');
                    $table->integer('user_id');
                    $table->integer('role_id');
                    $table->timestamps();

                    $table->unique(array('role_id', 'user_id'));
            });
        }

        public function down()
        {
            Schema::dropIfExists('user_role');
        }
}
