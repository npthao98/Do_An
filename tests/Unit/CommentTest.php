<?php

namespace Tests\Unit;

use App\Comment;
use App\Product;
use App\User;
use Tests\TestCase;

class CommentTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $comment;

    protected function setUp(): void
    {
        parent::setUp();
        $this->comment = new Comment();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->comment);
    }

    public function testTableName()
    {
        $this->assertEquals('comments', $this->comment->getTable());
    }

    public function testFillable()
    {
        $this->assertEquals([
            'user_id',
            'product_id',
            'content',
        ], $this->comment->getFillable());
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->comment->getKeyName());
    }

    public function testUserRelation()
    {
        $this->testBelongToRelation(
            User::class,
            'user_id',
            'id',
            $this->comment->user()
        );
    }

    public function testProductRelation()
    {
        $this->testBelongToRelation(
            Product::class,
            'product_id',
            'id',
            $this->comment->product()
        );
    }
}
