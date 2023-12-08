<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('air_ducts', function (Blueprint $table) {
            $table->id();
            $table->enum('num_furnace', ['1', '2','3+']);
            $table->integer('square_footage_min')->default(0);
            $table->integer('square_footage_max')->default(0);
            $table->integer('furnace_loc_sidebyside')->default(0);
            $table->integer('furnace_loc_different')->default(0);
            $table->integer('final_price')->default(0);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('air_ducts');
    }
};
