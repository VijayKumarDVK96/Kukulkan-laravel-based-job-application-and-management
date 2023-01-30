<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/*
// Create a test in the Feature directory...
php artisan make:test AdminTest

// Create a test in the Unit directory...
php artisan make:test AdminTest --unit
*/

class AdminTest extends TestCase {
    // use RefreshDatabase;
    use DatabaseMigrations;

    // public function testLogin() {
    //     // $this->withoutExceptionHandling();
    //     // $response = $this->post('login', [
    //     //     'email'    => 'admin@gmail.com',
    //     //     'password' => 'admin',
    //     // ]);
    //     // // $response->assertSessionHas('ss', 'ss');

    //     // ->each(function ($user) {
    //     //     $user->roles()->save(factory(App\Http\Models\Role::class)->make());
    //     // });
    //     $this->actingAs(factory(User::class)->create());
    //     $response = $this->get('admin/dashboard');

    //     // $response = $this->assertDatabaseHas('users', [
    //     //     'email' => 'admin@gmail.com',
    //     // ]);
    //     $response->assertStatus(200);
    //     $this->assertAuthenticated($guard = null);
    // }
    
    public function testExample() {
        // $this->withoutExceptionHandling(); // Debug
        // $response = $this->get('admin/staffs'); // Act
        // $response->assertStatus(200); // Assert
        $this->assertTrue(true);
    }
}