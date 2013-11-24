<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function(Blueprint $table)
		{
			//
                    $table->bigIncrements("id");
                    $table->string("username", 30)->unique();
                    $table->string("password", 50);
                    $table->string("email", 100)->nullable()->default(null);
                    $table->string("first_name", 100)->nullable()->default(null);
                    $table->string("last_name", 100)->nullable()->default(null);
                    $table->string("phone", 30)->nullable()->default(null);
                    $table->string("cellphone", 30)->nullable()->default(null);
                    $table->text("location")->nullable()->default(null);
                    $table->enum("gender", array('male', 'female'))->nullable()->default(null);
                    $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
                    Schema::dropIfExists("user");
	}

}
