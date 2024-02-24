<?php

namespace Tests\Feature\Http\Controllers;

use App\Product;
use App\Product,;
use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductsController
 */
class ProductsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $products = factory(Products::class, 3)->create();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $products = factory(Products::class, 3)->create();

        $response = $this->get(route('product.create'));

        $response->assertOk();
        $response->assertViewIs('products.create');
        $response->assertViewHas('productCategories');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductsController::class,
            'store',
            \App\Http\Requests\ProductsStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->word;
        $price = $this->faker->word;
        $size = $this->faker->word;
        $weight = $this->faker->word;
        $weight_unit = $this->faker->word;
        $description = $this->faker->word;
        $category_id = $this->faker->word;

        $response = $this->post(route('product.store'), [
            'name' => $name,
            'price' => $price,
            'size' => $size,
            'weight' => $weight,
            'weight_unit' => $weight_unit,
            'description' => $description,
            'category_id' => $category_id,
        ]);

        $products = Product::query()
            ->where('name', $name)
            ->where('price', $price)
            ->where('size', $size)
            ->where('weight', $weight)
            ->where('weight_unit', $weight_unit)
            ->where('description', $description)
            ->where('category_id', $category_id)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.name', $product->name);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $product = factory(Products::class)->create();
        $product = factory(Product::class)->create();

        $response = $this->get(route('product.show', $product));

        $response->assertOk();
        $response->assertViewIs('products.show');
        $response->assertViewHas('product');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $product = factory(Products::class)->create();
        $product = factory(Product::class)->create();
        $products = factory(Product::class, 3)->create();

        $response = $this->get(route('product.edit', $product));

        $response->assertOk();
        $response->assertViewIs('products.edit');
        $response->assertViewHas('product');
        $response->assertViewHas('productCategories');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductsController::class,
            'update',
            \App\Http\Requests\ProductsUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $product = factory(Products::class)->create();
        $product = factory(Product::class)->create();
        $name = $this->faker->word;
        $price = $this->faker->word;
        $size = $this->faker->word;
        $weight = $this->faker->word;
        $weight_unit = $this->faker->word;
        $description = $this->faker->word;
        $category_id = $this->faker->word;

        $response = $this->put(route('product.update', $product), [
            'name' => $name,
            'price' => $price,
            'size' => $size,
            'weight' => $weight,
            'weight_unit' => $weight_unit,
            'description' => $description,
            'category_id' => $category_id,
        ]);

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.name', $product->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $product = factory(Products::class)->create();
        $product = factory(Product::class)->create();

        $response = $this->delete(route('product.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertDeleted($product);
    }
}
