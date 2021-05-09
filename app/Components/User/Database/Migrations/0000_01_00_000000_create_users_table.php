<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->bigIncrements('id');
            $table->unsignedSmallInteger('status_id');
            $table->unsignedSmallInteger('entity_id');
            $table->unsignedInteger('contractor_id');
            $table->string('email')->unique();
            $table->string('password');

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');

            $table->foreign('contractor_id')
                ->references('id')
                ->on('contractors.contractors');

            $table->foreign('entity_id')
                ->references('id')
                ->on('entities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
