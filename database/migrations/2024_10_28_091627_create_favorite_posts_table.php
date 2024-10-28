<?php

use App\Models\Posts;
use App\Models\User;
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
        Schema::create('favorite_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Posts::class,'post_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class,'user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorite_posts');
    }
};
