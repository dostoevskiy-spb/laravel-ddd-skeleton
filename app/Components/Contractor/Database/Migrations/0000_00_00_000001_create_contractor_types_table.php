<?php

/** @noinspection PhpIllegalPsrClassPathInspection */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractorTypesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('types', function (Blueprint $table): void {
            $table->smallIncrements('id');
            $table->string('name', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
}
