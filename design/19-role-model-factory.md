下面是角色（Role）的模型和工厂（Factory）的示例代码：

```php
// Role.php (位于 app/Models/Role.php)

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_default',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
```

```php
// RoleFactory.php (位于 database/factories/RoleFactory.php)

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->sentence,
            'is_default' => $this->faker->boolean,
        ];
    }
}
```

要使用该工厂生成角色的示例，请在测试文件或其他适当的位置调用 `Role::factory()->create()`。

```php
// 示例测试代码
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
}
```

这样，您就可以使用上述示例代码生成角色的模型和工厂，并创建相应的测试方法。
