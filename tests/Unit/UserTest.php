<?php

namespace Tests\Unit;

use App\Comment;
use App\Rate;
use App\Order;
use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->user);
    }

    public function testTableName()
    {
        $this->assertEquals('users', $this->user->getTable());
    }

    public function testFillable()
    {
        $this->assertEquals([
            'name',
            'email',
            'password',
            'phone',
            'address',
            'role',
        ], $this->user->getFillable());
    }

    public function testHidden()
    {
        $this->assertEquals([
            'password',
            'remember_token',
        ], $this->user->getHidden());
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->user->getKeyName());
    }

    public function testCommentRelation()
    {
        $this->testHasManyRelation(
            Comment::class,
            'user_id',
            $this->user->comments()
        );
    }

    public function testOrderRelation()
    {
        $this->testHasManyRelation(
            Order::class,
            'user_id',
            $this->user->orders()
        );
    }

    public function testRateRelation()
    {
        $this->testHasManyRelation(
            Rate::class,
            'user_id',
            $this->user->rates()
        );
    }
}
