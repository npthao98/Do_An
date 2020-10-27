<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Tests\TestCase;
use Mockery;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Admin\CategoryController;
use Faker\Factory as Faker;
use Illuminate\Http\RedirectResponse;

class CategoryControllerTest extends TestCase
{
    protected $categoryMock;

    public function setUp(): void
    {
        $this->categoryMock = Mockery::mock(CategoryRepositoryInterface::class);
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_function()
    {
        $this->categoryMock
            ->shouldReceive('getAll')
            ->once()
            ->andReturn(new Collection);
        $category = new CategoryController($this->categoryMock);
        $result = $category->index();
        $data = $result->getData();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('categories', $data);
    }

    public function test_store_function()
    {
        $faker = Faker::create();
        $this->categoryMock
            ->shouldReceive('create')
            ->once()
            ->andReturn(true);
        $name = $faker->name;
        $data = [
            'name' => $name,
            'parent_id' => 2
        ];
        $request = new CategoryRequest($data);
        $category = new CategoryController($this->categoryMock);
        $result = $category->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('admin.categories.index'), $result->headers->get('Location'));
    }

    public function test_store_function_fail()
    {
        $faker = Faker::create();
        $this->categoryMock
            ->shouldReceive('create')
            ->once()
            ->andThrow(new Exception());
        $name = $faker->name;
        $data = [
            'name' => $name,
            'parent_id' => config('category.category_id')[array_rand(config('category.category_id'))]
        ];
        $request = new CategoryRequest($data);
        $category = new CategoryController($this->categoryMock);
        $result = $category->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertTrue($result->isRedirect());
    }

    public function test_update_function()
    {
        $faker = Faker::create();
        $this->categoryMock
            ->shouldReceive('update')
            ->once()
            ->andReturn(true);
        $name = $faker->name;
        $data = [
            'name' => $name,
            'parent_id' => 2
        ];
        $request = new CategoryRequest($data);
        $category = new CategoryController($this->categoryMock);
        $id = rand();
        $result = $category->update($id, $request);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('admin.categories.index'), $result->headers->get('Location'));
    }

    public function test_update_function_fail()
    {
        $faker = Faker::create();
        $this->categoryMock
            ->shouldReceive('update')
            ->once()
            ->andThrow(new Exception());
        $name = $faker->name;
        $data = [
            'name' => $name,
            'parent_id' => config('category.category_id')[array_rand(config('category.category_id'))]
        ];
        $request = new CategoryRequest($data);
        $category = new CategoryController($this->categoryMock);
        $id = rand();
        $result = $category->update($id, $request);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertTrue($result->isRedirect());
    }

    public function test_destroy_function()
    {
        $data = [
            'id' => 1
        ];
        $request = new Request($data);
        $this->categoryMock
            ->shouldReceive('deleteCategory')
            ->once()
            ->andReturn(new Category());
        $category = new CategoryController($this->categoryMock);
        $id = rand();
        $result = $category->destroy($id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertEquals(route('admin.categories.index'), $result->headers->get('Location'));
    }

    public function test_destroy_function_fail()
    {
        $data = [
            'id' => 1
        ];
        $request = new Request($data);
        $this->categoryMock
            ->shouldReceive('deleteCategory')
            ->once()
            ->andThrow(new Exception());
        $category = new CategoryController($this->categoryMock);
        $id = rand();
        $result = $category->destroy($id);
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertTrue($result->isRedirect());
    }
}
