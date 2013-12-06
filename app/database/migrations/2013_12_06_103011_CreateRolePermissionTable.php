<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolePermissionTable extends Migration {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('role_permission', function(Blueprint $table)
            {
                    $table->increments('id');
                    $table->integer('role_id');
                    $table->integer('permission_id');
                    $table->timestamps();

                    $table->unique(array('role_id', 'permission_id'));
            });
        }

        public function down()
        {
            Schema::dropIfExists('role_permission');
        }
}
