<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
			$table->id();
			$table->foreignId('book_id')->constrained();
			$table->foreignId('librarian_id')->constrained();
			$table->foreignId('reader_id')->constrained();
			$table->date('period_start')->nullable();
			$table->date('period_end')->nullable();
			$table->date('return_date')->nullable();
			$table->enum('status',['issued','returned'])->nullable();
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
        Schema::dropIfExists('borrowings');
    }
};
