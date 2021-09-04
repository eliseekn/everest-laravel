<?php

namespace Tests\Feature;

use App\Models\Comment;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCanStoreComment()
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $post = Post::factory()->for($user)->create(['image' => UploadedFile::fake()->image($this->faker->word())]);
        $comment = Comment::factory()->for($post)->create();

        $this->actingAs($user)->post(route('post.store'), $post->toArray());

        $response = $this->actingAs($user)->post(route('post.comment.store', $comment->post_id), $comment->toArray());
        $response->assertSessionHas('success', 'Comment has been created successfully');

        $this->assertDatabaseHas('comments', ['author' => $comment->author]);
    }

    public function testCanDeleteComment()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $post = Post::factory()->for($user)->create(['image' => UploadedFile::fake()->image($this->faker->word())]);
        $comment = Comment::factory()->for($post)->create();

        $this->actingAs($user)->post(route('post.store'), $post->toArray());
        $this->actingAs($user)->post(route('post.comment.store', $comment->post_id), $comment->toArray());

        $response = $this->actingAs($user)->delete(route('post.comment.destroy', ['post' => $comment->post_id, 'comment' => $comment->id]));
        $response->assertSessionHas('success', 'Comment has been deleted successfully');

        $this->assertDeleted($comment);
    }
}
