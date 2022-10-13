<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh');
        $this->artisan('db:seed');
    }

    /**
     * @test
     * @return void
     */
    public function root_endpoint_response_matches()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function get_comments_by_postId_endpoint_response_matches()
    {
        $response = $this->get('/api/blog-post/1/comments');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function create_comment_endpoint_fails_on_bad_payload()
    {
        $response = $this->postJson(
            '/api/blog-post/1/comment',
            [
                "name" => "test",
            ]
        );
        $response->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    public function create_comment_endpoint_fails_due_unexisting_parent_comment()
    {
        $response = $this->postJson(
            '/api/blog-post/1/comment',
            [
                "parentId" => 99,
                "name" => "test",
                "message" => "message-test",
            ]
        );
        $response->assertStatus(404);
    }

    /**
     * @test
     * @return void
     */
    public function create_first_layer_comment_gives_created_response()
    {
        $response = $this->postJson(
            '/api/blog-post/1/comment',
            [
                "name" => "test",
                "message" => "message-test",
            ]
        );
        $response->assertStatus(201);
    }

    /**
     * @test
     * @return void
     */
    public function create_second_layer_comment_gives_created_response()
    {
        $response = $this->postJson(
            '/api/blog-post/1/comment',
            [
                "parentId" => 1,
                "name" => "test",
                "message" => "message-test",
            ]
        );
        $response->assertStatus(201);
    }

    /**
     * @test
     * @return void
     */
    public function create_third_layer_comment_gives_created_response()
    {
        $response = $this->postJson(
            '/api/blog-post/1/comment',
            [
                "parentId" => 2,
                "name" => "test",
                "message" => "message-test",
            ]
        );
        $response->assertStatus(201);
    }

    /**
     * @test
     * @return void
     */
    public function create_forth_layer_comment_gives_unprocessable_entity_response()
    {
        $response = $this->postJson(
            '/api/blog-post/1/comment',
            [
                "parentId" => 4,
                "name" => "test",
                "message" => "message-test",
            ]
        );
        $response->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    public function update_comment_endpoint_fails_on_bad_payload()
    {
        $response = $this->putJson(
            '/api/blog-post/1/comment/1',
            []
        );
        $response->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    public function update_comment_endpoint_gives_successful_response()
    {
        $response = $this->putJson(
            '/api/blog-post/1/comment/1',
            [
                "message" => "message-test [updated]",
            ]
        );
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function delete_comment_endpoint_fails_due_unexisting_comment_id()
    {
        $response = $this->delete('/api/blog-post/1/comment/99');
        $response->assertStatus(422);
    }

    /**
     * @test
     * @return void
     */
    public function delete_comment_endpoint_gives_successful_response()
    {
        $response = $this->delete('/api/blog-post/1/comment/12');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @return void
     */
    public function delete_comments_on_cascade_endpoint_gives_successful_response()
    {
        $response = $this->delete('/api/blog-post/1/comment/1');
        $response->assertStatus(200);
    }
}
