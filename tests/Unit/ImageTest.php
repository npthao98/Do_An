<?php

namespace Tests\Unit;

use App\Product;
use App\Image;
use Tests\TestCase;

class ImageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $image;

    protected function setUp(): void
    {
        parent::setUp();
        $this->image = new Image();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->image);
    }

    public function testTableName()
    {
        $this->assertEquals('images', $this->image->getTable());
    }

    public function testFillable()
    {
        $this->assertEquals([
            'product_id',
            'link_to_image',
        ], $this->image->getFillable());
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->image->getKeyName());
    }

    public function testProductRelation()
    {
        $this->testBelongToRelation(
            Product::class,
            'product_id',
            'id',
            $this->image->product()
        );
    }
}
