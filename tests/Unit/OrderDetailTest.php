<?php

namespace Tests\Unit;

use App\Order;
use App\OrderDetail;
use App\ProductDetail;
use Tests\TestCase;

class OrderDetailTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $orderDetail;

    protected function setUp(): void
    {
        parent::setUp();
        $this->orderDetail = new OrderDetail();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->orderDetail);
    }

    public function testTableName()
    {
        $this->assertEquals('order_detail', $this->orderDetail->getTable());
    }

    public function testFillable()
    {
        $this->assertEquals([
            'order_id',
            'product_detail_id',
            'quantity',
        ], $this->orderDetail->getFillable());
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->orderDetail->getKeyName());
    }

    public function testOrderRelation()
    {
        $this->testBelongToRelation(
            Order::class,
            'order_id',
            'id',
            $this->orderDetail->order()
        );
    }

    public function testProductDetailRelation()
    {
        $this->testBelongToRelation(
            ProductDetail::class,
            'product_detail_id',
            'id',
            $this->orderDetail->productDetail()
        );
    }
}
