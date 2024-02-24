<?php

namespace Tests\Feature\Http\Controllers;

use App\ProductCategories,;
use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductCategoriesController
 */
class ProductCategoriesControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $productCategories = factory(ProductCategories::class, 3)->create();

        $response = $this->get(route('product-category.index'));

        $response->assertOk();
        $response->assertViewIs('product-categories.index');
        $response->assertViewHas('productCategories');
    }


    /**
     * @test
     */
    public function create_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductCategoriesController::class,
            'create',
            \App\Http\Requests\ProductCategoriesCreateRequest::class
        );
    }

    /**
     * @test
     */
    public function create_redirects()
    {
        $name = $this->faker->word;
        $description = $this->faker->word;

        $response = $this->get(route('product-category.create'), [
            'name' => $name,
            'description' => $description,
        ]);

        $response->assertRedirect(route('product-categories.index'));
        $response->assertSessionHas('productCategory', $productCategory);
        $response->assertSessionHas('productCategory.name', $productCategory->name);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductCategoriesController::class,
            'update',
            \App\Http\Requests\ProductCategoriesUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $productCategory = factory(ProductCategories::class)->create();
        $productCategory = factory(ProductCategory::class)->create();
        $name = $this->faker->word;
        $description = $this->faker->word;

        $response = $this->put(route('product-category.update', $productCategory), [
            'name' => $name,
            'description' => $description,
        ]);

        $response->assertRedirect(route('product-categories.index'));
        $response->assertSessionHas('productCategory.name', $productCategory->name);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $productCategory = factory(ProductCategories::class)->create();
        $productCategory = factory(ProductCategory::class)->create();

        $response = $this->delete(route('product-category.destroy', $productCategory));

        $response->assertRedirect(route('product-categories.index'));

        $this->assertDeleted($productCategory);
    }
}
