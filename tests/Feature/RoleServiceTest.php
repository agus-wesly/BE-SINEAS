<?php

namespace Tests\Feature;

use App\Services\Role\IRoleService;
use App\Services\Role\RoleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleServiceTest extends TestCase
{
    private IRoleService $roleService;
    private int $roleId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->roleService = $this->spy(IRoleService::class);
        $this->app->instance(IRoleService::class, RoleService::class);
        $this->roleId = 1;
    }

    public function expectedRequest(){
        return [
            'name' => 'joe',
        ];
    }

    private function ExpectedListRole()
    {
        return [
            [
                "id" => 1,
                "name" => "admin",
                "created_at" => "2021-05-25T07:00:00.000000Z",
                "updated_at" => "2021-05-25T07:00:00.000000Z"
            ],
            [
                "id" => 2,
                "name" => "user",
                "created_at" => "2021-05-25T07:00:00.000000Z",
                "updated_at" => "2021-05-25T07:00:00.000000Z"
            ]
        ];
    }

    public function test_will_return_service_not_null(): void
    {
        $this->assertNotNull($this->roleService);
    }

    public function test_will_return_list_role(): void
    {
        // arrange
        $result = $this->ExpectedListRole();
       $this->roleService
            ->shouldReceive('getAllRole')
           ->andReturn(collect($result));

        // act
        $response = $this->roleService->getAllRole();

        // assert
        $this->assertEquals(collect($result), $response);
    }

    public function test_will_return_empty_roles(): void
    {
        // arrange
        $this->roleService
            ->shouldReceive('getAllRole')
            ->andReturn(collect([]));
        // act
        $response = $this->roleService->getAllRole();

        // assert
        $this->assertEmpty($response);
    }

    public function test_will_return_role_by_id(): void
    {
        // arrange
        $result = $this->ExpectedListRole();
        $roleId = $this->roleId;
        $this->roleService
            ->shouldReceive('getRoleById')
            ->withArgs([$roleId])
            ->andReturn(collect($result[0]));

        // act
        $response = $this->roleService->getRoleById($roleId);

        // assert
        $this->assertEquals(collect($result[0]), $response);
    }

    public function test_create_role_is_success(): void
    {
        // arrange
        $request = $this->expectedRequest();

        $this->roleService
            ->shouldReceive('createRole')
            ->withArgs([$request])
            ->andReturnTrue();

        // act
        $response = $this->roleService->createRole($request);

        // assert
        $this->assertTrue($response);
    }

    public function test_create_role_is_fail(): void
    {
        // arrange
        $request = $this->expectedRequest();
        $request['name'] = '';
        $this->roleService
            ->shouldReceive('createRole')
            ->withArgs([$request])
            ->andReturnFalse();

        // act
        $response = $this->roleService->createRole($request);

        // assert
        $this->assertFalse($response);
    }

    public function test_update_role_is_success(): void
    {
        // arrange
        $request = $this->expectedRequest();
        $roleId = $this->roleId;
        $this->roleService
            ->shouldReceive('updateRole')
            ->withArgs([$request, $roleId])
            ->andReturnTrue();

        // act
        $response = $this->roleService->updateRole($request, $roleId);

        // assert
        $this->assertTrue($response);
    }

    public function test_update_role_is_fail(): void
    {
        // arrange
        $request = $this->expectedRequest();
        $roleId = 1000;

        $this->roleService
            ->shouldReceive('updateRole')
            ->withArgs([$request, $roleId])
            ->andReturnFalse();

        // act
        $response = $this->roleService->updateRole($request, $roleId);

        // assert
        $this->assertFalse($response);
    }

    public function test_delete_role_is_success(): void
    {
        // arrange
        $roleId = $this->roleId;
        $this->roleService
            ->shouldReceive('deleteRole')
            ->withArgs([$roleId])
            ->andReturnTrue();

        // act
        $response = $this->roleService->deleteRole($roleId);

        // assert
        $this->assertTrue($response);
    }

    public function test_delete_role_is_fail(): void
    {
        // arrange
        $roleId = 1000;
        $this->roleService
            ->shouldReceive('deleteRole')
            ->withArgs([$roleId])
            ->andReturnFalse();

        // act
        $response = $this->roleService->deleteRole($roleId);

        // assert
        $this->assertFalse($response);
    }


    public function tearDown(): void
    {
        parent::tearDown();
        unset($this->roleService);
    }



}
