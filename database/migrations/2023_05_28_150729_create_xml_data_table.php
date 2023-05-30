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
        Schema::create('xml_data', function (Blueprint $table) {
            $table->id();
            $table->integer("entity_id")->unique();
            $table->string("category_name")->nullable();
            $table->string("sku")->nullable();
            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->text("shortdesc")->nullable();
            $table->float('price', 8, 2)->nullable();
            $table->string("link")->nullable();
            $table->string("image")->nullable();
            $table->string("brand")->nullable();
            $table->string("rating")->nullable();
            $table->string("caffeine_type")->nullable();
            $table->string("count")->nullable();
            $table->string("flavored")->nullable();
            $table->string("seasonal")->nullable();
            $table->string("instock")->nullable();
            $table->boolean("facebook")->default(0);
            $table->boolean("IsKCup")->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xml_data');
    }
};
