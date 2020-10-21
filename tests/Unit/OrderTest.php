<?php

namespace Tests\Unit;

use App\Order;
use App\OrderDetail;
use App\User;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $order;

    protected function setUp(): void
    {
        parent::setUp();
        $this->order = new Order();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->order);
    }

    public function testTableName()
    {
        $this->assertEquals('orders', $this->order->getTable());
    }

    public function testFillable()
    {
        $this->assertEquals([
            'user_id',
            'status',
            'price',
            'name',
            'email',
            'phone',
            'address',
        ], $this->order->getFillable());
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->order->getKeyName());
    }

    public function testUserRelation()
    {
        $this->testBelongToRelation(
            User::class,
            'user_id',
            'id',
            $this->order->user()
        );
    }

    public function testOrderDetailRelation()
    {
        $this->testHasManyRelation(
            OrderDetail::class,
            'order_id',
            $this->order->orderDetails()
        );
    }
}
