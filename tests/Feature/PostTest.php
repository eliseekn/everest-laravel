<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCanNotStorePostIfNotAuthenticated()
    {
        $post = Post::factory()->create();

        $response = $this->post(route('post.store'), $post->toArray());
        $response->assertRedirect();
    }

    public function testCanNotStorePostIfNotRoleIsUser()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create(['image' => UploadedFile::fake()->image($this->faker->word())]);

        $response = $this->actingAs($user)->post(route('post.store'), $post->toArray());
        $response->assertStatus(403);
    }

    public function testCanStorePost()
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $post = Post::factory()->for($user)->create(['image' => UploadedFile::fake()->image($this->faker->word())]);

        $response = $this->actingAs($user)->post(route('post.store'), $post->toArray());
        $response->assertSessionHas('success', 'Post has been created successfully');

        $this->assertDatabaseHas('posts', ['title' => $post->title]);
    }

    public function testCanUpdatePost()
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $post = Post::factory()->for($user)->create(['image' => UploadedFile::fake()->image($this->faker->word())]);

        $this->actingAs($user)->post(route('post.store'), $post->toArray());

        $post->title = $this->faker->sentence();
        $post->image = UploadedFile::fake()->image($this->faker->word());
        
        $response = $this->actingAs($user)->patch(route('post.update', $post->id), $post->toArray());
        $response->assertSessionHas('success', 'Post has been updated successfully');

        $this->assertDatabaseHas('posts', ['title' => $post->title]);
    }

    public function testCanDestroyPost()
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $post = Post::factory()->for($user)->create(['image' => UploadedFile::fake()->image($this->faker->word())]);

        $this->actingAs($user)->post(route('post.store'), $post->toArray());

        $response = $this->actingAs($user)->delete(route('post.destroy', $post->id));
        $response->assertSessionHas('success', 'Post has been deleted successfully');

        $this->assertDeleted($post);
    }

    public function testCanGetPost()
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $post = Post::factory()->for($user)->create(['image' => UploadedFile::fake()->image($this->faker->word())]);

        $this->actingAs($user)->post(route('post.store'), $post->toArray());

        $response = $this->get(route('post.show', $post->id));
        $response->assertOk();
    }
}
