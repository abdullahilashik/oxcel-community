<?php

use App\Models\PostComment;
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
        Schema::create('post_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            // $table->foreignIdFor(Posts::class, 'post_id');
            $table->foreignIdFor(PostComment::class, 'comment_id');
            $table->foreignIdFor(User::class, 'user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_comment_replies');
    }
};
