<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Category;
use App\Models\Product_image;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_user_can_see_all_product()
    {
        $products = Product::factory()->count(6)->create(
            ['category_id' => Category::factory()->create()->id]
        );
        $product = $products->first();
        $response = $this->actingAs($this->user)->get(route('product.index'));
        // dd($response->exception);
        $response->assertStatus(200)
            ->assertViewis('product.index')
            ->assertViewHas('products')
            ->assertsee($product->name);
    }
    public function test_user_can_see_add_product()
    {
        $data = $this->user;
        $response = $this->actingAs($data)->get(route('product.create'));
        $response->assertStatus(200)
            ->assertViewis('product.create');
    }
    public function test_user_can_add_product()
    {
        $data = $this->user;
        $category = Category::factory()->create();
        $input = Product::factory()->create([
            'category_id'=>$category->id,
        ]);
        $input['image'] = "adjfkahd";
        $response = $this->actingAs($data)
            ->post(route('product.store'), [$input]);
        $response->assertStatus(302);
    }
    public function test_user_can_not_add_product()
    {
        $data = $this->user;
        $category = Category::factory()->create();
        $input = Product::factory()->create([
            'category_id'=>$category->id,
        ]);
        $input['image'] = "adjfkahd";
        $response = $this->actingAs($data)
            ->post(route('product.store'), [$input]);
        $response->assertStatus(302)
            ->assertSessionHasErrors('name', 'The name field is required')
            ->assertSessionHasErrors('is_active', 'The is_active must be true or false is required');
    }
    public function test_user_can_see_edit_product()
    {
        $product = Product::factory()->create([
            "category_id"=> Category::factory()->create()->id, 
        ]);
        $response = $this->actingAs($this->user)->get(route('product.edit', $product->id));
        $response->assertStatus(200)
            ->assertViewis('product.edit')
            ->assertViewHas('product');
    }
    public function test_user_can_update_product()
    {
        $input = Product::factory([
            "category_id" => Category::factory()->create()->id,
        ])->create();
        $input['image_data'] = Product_image::factory()->count(3)->create(['product_id'=>$input->id])->id;
        $b=0;
        $input['is_primary']=[];
       foreach( $input['image_data'] as $a){
        $input['is_primary'][$b]=fake()->boolean();
        $b++;
       }
        $response = $this->actingAs($this->user)->put(route('product.update', $input->id), $input);
        $response->AssertRedirectToRoute('product.index');
        $this->assertDatabaseHas('categories', ['name' => $input->name]);
    }
    public function test_user_can_delete_category()
    {
        $category = Category::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('category.destroy', $category->id));
        $response->AssertRedirectToRoute('category.index');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}