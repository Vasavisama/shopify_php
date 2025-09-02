<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_stores_on_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $store = Store::factory()->create(['user_id' => $admin->id]);

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'api');

        $response = $this->get(route('dashboard.user'));

        $response->assertStatus(200);
        $response->assertSee($store->name);
    }

    public function test_user_can_view_products_in_a_store()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $store = Store::factory()->create(['user_id' => $admin->id]);
        $product = Product::factory()->create(['store_id' => $store->id]);

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'api');

        $response = $this->get(route('customer.stores.show', $store));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_user_can_add_product_to_cart()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $store = Store::factory()->create(['user_id' => $admin->id]);
        $product = Product::factory()->create(['store_id' => $store->id]);

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'api');

        $this->post(route('cart.add', $product));

        $this->get(route('cart.index'))
            ->assertSee($product->name);
    }

    public function test_user_can_increment_product_in_cart()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $store = Store::factory()->create(['user_id' => $admin->id]);
        $product = Product::factory()->create(['store_id' => $store->id]);

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'api');

        $this->post(route('cart.add', $product));
        $this->post(route('cart.increment', $product));

        $this->get(route('cart.index'))
            ->assertSee($product->name)
            ->assertSee('2');
    }

    public function test_user_can_decrement_product_in_cart()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $store = Store::factory()->create(['user_id' => $admin->id]);
        $product = Product::factory()->create(['store_id' => $store->id]);

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'api');

        $this->post(route('cart.add', $product));
        $this->post(route('cart.increment', $product));
        $this->post(route('cart.decrement', $product));

        $this->get(route('cart.index'))
            ->assertSee($product->name)
            ->assertSee('1');
    }

    public function test_user_can_remove_product_from_cart()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $store = Store::factory()->create(['user_id' => $admin->id]);
        $product = Product::factory()->create(['store_id' => $store->id]);

        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user, 'api');

        $this->post(route('cart.add', $product));
        $this->post(route('cart.remove', $product));

        $this->get(route('cart.index'))
            ->assertDontSee($product->name);
    }
}
