<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Tax;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaxesControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    public function expectRequest()
    {
        return [
            'name' => 'pajak movie',
            'price' => fake()->numberBetween(1000, 1000000),
            'status' => fake()->boolean,
        ];
    }

    public function setUp(): void
    {
        parent::setUp();
        $role = Role::factory()->create();
        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);
        $this->actingAs($user);

    }

    public function test_taxes_page_list_is_displayed()
    {
        // act
        $response = $this->get('/taxes');

        // assert
        $response
            ->assertSeeText('Taxes List')
            ->assertOk();
    }

    public function test_taxes_page_create_is_displayed()
    {
        // act
        $response = $this->get(route('taxes.create'));

        // assert
        $response
            ->assertSeeText('Create Taxes')
            ->assertOk();
    }

    public function test_taxes_page_edit_is_displayed()
    {
        // arrange
        $taxes = Tax::factory()->create();

        // act
        $response = $this->get(route('taxes.edit', $taxes->id));

        // assert
        $response
            ->assertSeeText('Sineashub')
            ->assertOk();
    }

    public function test_create_taxes_success()
    {
        // arrange
        $request = $this->expectRequest();

        // act
        $response = $this->post(route('taxes.store'), $request);

        // assert
        $response->assertRedirect(route('taxes.index'));
        $this->assertDatabaseHas('taxes', $request);
    }


    public function test_taxes_page_delete_is_displayed()
    {
        // arrange
        $taxes = Tax::factory()->create();

        // act
        $response = $this->get(route('taxes.edit', $taxes->id));

        // assert
        $response
            ->assertSeeText('Sineashub')
            ->assertOk();
    }

    public function test_update_taxes_success()
    {
        // arrange
        $taxes = Tax::factory()->create();
        $request = $this->expectRequest();

        // act
        $response = $this->put(route('taxes.update', $taxes->id), $request);

        // assert
        $response->assertRedirect(route('taxes.index'));
        $this->assertDatabaseHas('taxes', $request);
    }

    public function test_delete_taxes_success()
    {
        // arrange
        $taxes = Tax::factory()->create();

        // act
        $response = $this->delete(route('taxes.destroy', $taxes->id));

        // assert
        $response->assertRedirect(route('taxes.index'));
        $this->assertDatabaseMissing('taxes', $taxes->toArray());
    }

    public function test_create_taxes_name_is_required()
    {
        // arrange
        $request = $this->expectRequest();
        $request['name'] = '';

        // act
        $response = $this->post(route('taxes.store'), $request);

        // assert
        $response->assertSessionHasErrors('name');
    }
    public function test_create_taxes_name_already_exists()
    {
        // arrange
        $request = $this->expectRequest();

        // act
        $this->post(route('taxes.store'), $request);
        $response = $this->post(route('taxes.store'), $request);

        // assert
        $response->assertSessionHasErrors('name');
    }

    public function test_create_texes_price_is_required()
    {
        // arrange
        $request = $this->expectRequest();
        $request['price'] = '';

        // act
        $response = $this->post(route('taxes.store'), $request);

        // assert
        $response->assertSessionHasErrors('price');
    }

    public function test_create_texes_price_must_be_numeric()
    {
        // arrange
        $request = $this->expectRequest();
        $request['price'] = 1000.10;

        // act
        $response = $this->post(route('taxes.store'), $request);

        // assert
        $response->assertSessionHasErrors('price');
    }

    public function test_create_texes_price_cannot_be_minus()
    {
        // arrange
        $request = $this->expectRequest();
        $request['price'] = -100;

        // act
        $response = $this->post(route('taxes.store'), $request);

        // assert
        $response->assertSessionHasErrors('price');
    }

    public function test_create_texes_status_is_required()
    {
        // arrange
        $request = $this->expectRequest();
        $request['status'] = '';

        // act
        $response = $this->post(route('taxes.store'), $request);

        // assert
        $response->assertSessionHasErrors('status');
    }

    public function test_create_texes_status_is_must_be_boolean()
    {
        // arrange
        $request = $this->expectRequest();
        $request['status'] = 'not boolean';

        // act
        $response = $this->post(route('taxes.store'), $request);

        // assert
        $response->assertSessionHasErrors('status');
    }





}
