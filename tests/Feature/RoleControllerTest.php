<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    public function expectedRequest(){
        return [
            'name' => 'joe',
        ];
    }
    public function setUp(): void
    {
        parent::setUp();
    }

    public  function test_list_role_page_is_displayed()
    {
        // act
        $response = $this->get('/roles');

        // assert
        $response->assertOk();
    }

    public function test_role_page_create_is_displayed()
    {
        // act
        $response = $this->get(route('roles.create'));

        // assert
        $response->assertOk();
    }

    public function test_create_role_is_success(): void
    {
        // arrange
        $data = $this->expectedRequest();

        // act
        $response = $this->post(route('roles.store'), $data);

        // assert
        $response->assertRedirect(route('roles.index'));
    }

    public function test_create_role_is_fail(): void
    {
        // arrange
        $data = $this->expectedRequest();
        $data['name'] = '';

        // act
        $response = $this->post(route('roles.store'), $data);

        // assert
        $response->assertSessionHasErrors('name', 'Nama Role tidak boleh kosong');
    }

    public function test_page_role_edit_is_displayed()
    {
        // arrange
        $data = $this->expectedRequest();
        $this->post(route('roles.store'), $data);
        $role = \App\Models\Role::first();

        // act
        $response = $this->get(route('roles.edit', $role->id));

        // assert
        $response
            ->assertSeeText('Edit Role')
            ->assertSee('joe')
            ->assertOk();
    }

    public function test_update_role_is_success(): void
    {
        // arrange
        $data = $this->expectedRequest();
        $this->post(route('roles.store'), $data);
        $role = \App\Models\Role::first();
        $data['name'] = 'joe2';

        // act
        $response = $this->put(route('roles.update', $role->id), $data);

        // assert
        $response->assertRedirect(route('roles.index'));
    }

    public function test_update_role_is_fail(): void
    {
        // arrange
        $data = $this->expectedRequest();
        $this->post(route('roles.store'), $data);
        $role = \App\Models\Role::first();
        $data['name'] = '';

        // act
        $response = $this->put(route('roles.update', $role->id), $data);

        // assert
        $response->assertSessionHasErrors('name', 'Nama Role tidak boleh kosong');
    }

    public function test_delete_role_is_success(): void
    {
        // arrange
        $data = $this->expectedRequest();
        $this->post(route('roles.store'), $data);
        $role = \App\Models\Role::first();

        // act
        $response = $this->delete(route('roles.destroy', $role->id));

        // assert
        $response->assertRedirect(route('roles.index'));
    }
}
