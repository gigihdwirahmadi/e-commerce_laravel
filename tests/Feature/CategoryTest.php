<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_user_can_see_all_category()
    {
     
        $categories = Category::factory()->count(6)->create();
        $category = $categories->first();
        $response = $this->actingAs($this->user)->get(route('category.index'));
        // dd($response->exception);
        $response->assertStatus(200)
            ->assertViewis('category.index')
            ->assertViewHas('categories')
            ->assertsee($category->name);
    }
    public function test_user_can_see_add_category()
    {
        $response = $this->actingAs($this->user)->get(route('category.create'));
        $response->assertStatus(200)
            ->assertViewis('category.create');
    }
    public function test_user_can_add_category()
    {
        $input = Category::factory()->make()->only('name', 'is_active');

        $response = $this->actingAs($this->user)
            ->post(route('category.store'), $input);
            $response->assertStatus(302);
        // $response->assertRedirectToRoute('category.index');

        // $this->assertDatabaseHas('category', [
        //     'name' => $input['name'],
        //     'is_active' => $input['is_active'],
        // ]);
    }
    public function test_user_can_not_add_category()
    {
        $input = Category::factory()->make()->only('is_active');
        $input['is_active']= 'jgfkdsk';

        $response = $this->actingAs($this->user)->post(route('category.store'), $input);
        $response
            ->assertStatus(302)
            ->assertSessionHasErrors('name', 'The name field is required')
            ->assertSessionHasErrors('is_active', 'The is_active must be true or false is required');
    }
    public function test_user_can_see_edit_category()
    {
        $category = Category::factory()->create();
        $response = $this->actingAs($this->user)->get(route('category.edit', $category->id));
        $response->assertStatus(200)
            ->assertViewis('category.edit')
            ->assertViewHas('category')
            ->assertsee($category->name);
    }
    public function test_user_can_update_category()
    {
        $category = Category::factory()->create();
        $category->name = "New Name";
        $response = $this->actingAs($this->user)->put(route('category.update', $category->id), $category->toArray());
        $response->AssertRedirectToRoute('category.index');
        $this->assertDatabaseHas('categories', ['name' => $category->name]);
    }
    public function test_user_can_delete_category()
    {
        $category = Category::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('category.destroy', $category->id));
        $response->AssertRedirectToRoute('category.index');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}