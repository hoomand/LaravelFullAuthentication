<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('group', function(Blueprint $table)
            {
                    $table->bigIncrements("id");
                    $table->string("name");
                    $table->timestamps();
            });
        }

        public function down()
        {
            Schema::dropIfExists('group');
        }

}
