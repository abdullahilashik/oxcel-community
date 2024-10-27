<?php

use App\Models\PostCategory;
use App\Models\Posts;
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
        Schema::create('post_category_rels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Posts::class, 'post_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(PostCategory::class, 'post_category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_category_rels');
    }
};
