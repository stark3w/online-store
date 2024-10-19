<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\BaseTestCase;

class ProductControllerTest extends BaseTestCase
{
    public function testIndexReturnsProductsForCatalog()
    {
        Product::factory(3)->create(['$catalog_id' => $this->catalog->id]);

        $response = $this->get(route('product.index', $this->catalog->slug));
        $response->assertSuccessful();
        $response->assertViewIs('products.index');

        $this->assertEquals($this->catalog->id, $response->viewData('catalog')->id);
        $this->assertCount(3, $response->viewData('products'));
    }

    public function testIndexReturns404ForNonExistentCatalog()
    {
        $response = $this->get(route('products.index', 'non-existent-slug'));

        $response->assertNotFound();
    }

   public function testStoreAddsProductToDatabase()
   {
        $product = Product::factory()->create([
            'catalog_id' => $this->catalog->id,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'catalog_id' => $this->catalog->id,
            'name' => $product->name,
        ]);
   }
}
