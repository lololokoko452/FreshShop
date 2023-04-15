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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->float("price");
            $table->foreignId("category_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string("imageName");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("product", function(Blueprint $table){
            $table->dropForeign("category_id");
        });
        Schema::dropIfExists('products');
    }
};
