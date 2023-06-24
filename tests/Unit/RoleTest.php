<?php

namespace Tests\Unit;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_role()
    {
        $role = Role::factory()->create();

        // 断言角色已成功创建
        $this->assertNotNull($role);
        $this->assertInstanceOf(Role::class, $role);
    }

    public function test_role_attributes()
    {
        $role = Role::factory()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrator role',
            'is_default' => true,
        ]);

        // 断言角色的属性值正确
        $this->assertEquals('Admin', $role->name);
        $this->assertEquals('admin', $role->slug);
        $this->assertEquals('Administrator role', $role->description);
        $this->assertTrue($role->is_default);
    }

    public function test_update_role()
    {
        $role = Role::factory()->create();

        $updatedData = [
            'name' => 'Updated Role',
            'slug' => 'updated-role',
            'description' => 'Updated role description',
            'is_default' => false,
        ];

        $role->update($updatedData);

        // 断言角色已成功更新
        $this->assertEquals('Updated Role', $role->name);
        $this->assertEquals('updated-role', $role->slug);
        $this->assertEquals('Updated role description', $role->description);
        $this->assertFalse($role->is_default);
    }

    public function test_delete_role()
    {
        $role = Role::factory()->create();

        $role->delete();

        // 断言角色已成功删除
        $this->assertSoftDeleted($role);
    }

    public function test_role_has_many_users()
    {
        $role = Role::factory()
            ->hasUsers(3)
            ->create();

        // 断言角色拥有三个用户
        $this->assertCount(3, $role->users);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $role->users);
        $this->assertInstanceOf('App\Models\User', $role->users->first());
    }
}
