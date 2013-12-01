<?php
use Illuminate\Database\Schema\Blueprint;
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
                    $table->date("deleted_at")->nullable();
            });
        }

        public function down()
        {
            Schema::dropIfExists('group');
        }

}
