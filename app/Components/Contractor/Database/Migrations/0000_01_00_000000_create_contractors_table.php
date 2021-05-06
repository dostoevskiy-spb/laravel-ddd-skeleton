<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contractors', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('status_id');
            $table->unsignedSmallInteger('type_id');
            $table->string('name');
            $table->string('code');
            $table->string('address');
            $table->string('inn');
            $table->string('ogrn');

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
            $table->foreign('type_id')
                ->references('id')
                ->on('types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contractors');
    }
}
