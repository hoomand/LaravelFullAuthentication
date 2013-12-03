<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('role', function(Blueprint $table)
            {
                    $table->increments("id");
                    $table->string("name");
                    $table->text("description");
                    $table->timestamps();
                    $table->date("deleted_at")->nullable();
            });
        }

        public function down()
        {
            Schema::dropIfExists('role');
        }

}
