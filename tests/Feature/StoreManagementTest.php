<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Theme;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_a_store_and_it_is_displayed_on_the_dashboard_and_stores_page()
    {
        // Create a user and act as the user
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user, 'web');

        // Create a theme
        $theme = Theme::create([
            'name' => 'Test Theme',
            'background_color' => '#0000ff',
            'font_style' => 'Roboto',
            'font_color' => '#ffffff',
            'font_size' => '20',
        ]);

        // The data to be sent with the request
        $storeData = [
            'name' => 'My Awesome Store',
            'domain' => 'my-awesome-store.com',
            'theme_id' => $theme->id,
            'description' => 'This is a test store.',
        ];

        // Post the data to the store creation endpoint
        $response = $this->post(route('admin.stores.store'), $storeData);

        // Assert that the request was successful and redirected to the stores index page
        $response->assertRedirect(route('admin.stores.index'));
        $response->assertSessionHas('success');

        // Assert that the store was created in the database
        $this->assertDatabaseHas('stores', [
            'name' => 'My Awesome Store',
            'domain' => 'my-awesome-store.com',
        ]);

        $store = Store::where('name', 'My Awesome Store')->first();

        // Visit the stores index page and assert that the store is visible
        $response = $this->get(route('admin.stores.index'));
        $response->assertStatus(200);
        $response->assertSee('My Awesome Store');
        $response->assertSee('background-color: #0000ff');
        $response->assertSee('font-family: Roboto');
        $response->assertSee('font-size: 20px');

        // Visit the dashboard and assert that the store is visible
        $response = $this->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('My Awesome Store');
        $response->assertSee('background-color: #0000ff');
        $response->assertSee('font-family: Roboto');
        $response->assertSee('font-size: 20px');

        // Visit the store's show page and assert that the store is visible
        $response = $this->get(route('admin.stores.show', $store));
        $response->assertStatus(200);
        $response->assertSee('My Awesome Store');
        $response->assertSee('Test Theme');
    }

    /** @test */
    public function products_are_displayed_as_cards_on_store_show_page()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user, 'web');
        $store = Store::factory()->create();
        $product = \App\Models\Product::factory()->create(['store_id' => $store->id]);

        $response = $this->get(route('admin.stores.show', $store));

        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->description);
        $response->assertSee(number_format($product->price, 2));
        $response->assertSee('grid');
    }

    /** @test */
    public function admin_can_view_their_profile()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin, 'web');

        $response = $this->get(route('admin.profile'));

        $response->assertStatus(200);
        $response->assertSee($admin->name);
        $response->assertSee($admin->email);
        $response->assertSee('Admin');
    }

    /** @test */
    public function store_without_theme_is_displayed_with_default_styles()
    {
        // Create a user and act as the user
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user, 'web');

        // Create a store without a theme
        $store = Store::factory()->create(['theme_id' => null]);

        // Visit the stores index page and assert that the store is visible with default styles
        $response = $this->get(route('admin.stores.index'));
        $response->assertStatus(200);
        $response->assertSee($store->name);
        $response->assertSee('background-color: #ffffff');
        $response->assertSee('font-family: normal');
        $response->assertSee('font-size: 16px');
    }
}
