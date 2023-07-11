当然，这是一个完整的示例，包括 `UserFactory`、`RoleSeeder` 和相关的模型和迁移文件。

首先是 `Role` 模型：

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_VENDOR = 'vendor';

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

接下来是 `RoleSeeder`：

```php
namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => Role::ROLE_ADMIN,
                'description' => 'Administrator role',
                'is_default' => true,
            ],
            [
                'name' => 'Customer',
                'slug' => Role::ROLE_CUSTOMER,
                'description' => 'Customer role',
                'is_default' => false,
            ],
            [
                'name' => 'Vendor',
                'slug' => Role::ROLE_VENDOR,
                'description' => 'Vendor role',
                'is_default' => false,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
```

然后是 `UserFactory`：

```php
namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'role_id' => Role::factory(),
            'remember_token' => Str::random(10),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'date_of_birth' => $this->faker->date,
            'is_verified' => false,
            'verification_token' => Str::random(60),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->beforeCreating(function (User $user) {
            if (!Role::count()) {
                $this->call(RoleSeeder::class);
            }

            $user->role_id = Role::query()->whereIn('slug', [
                Role::ROLE_ADMIN,
                Role::ROLE_CUSTOMER,
                Role::ROLE_VENDOR,
            ])->pluck('id')->random();
        });
    }
}
```

请确保在 `User` 模型中使用了 `HasFactory` trait，并在 `UserFactory` 类中定义了 `$model` 属性。

这样，当你在测试中使用 `User::factory()->create()` 时，将会创建带有随机角色的用户，且角色记录会在需要时使用 `RoleSeeder` 进行填充。

希望这能帮到你！如有任何其他问题，请随时提问。

非常抱歉，我误解了你的需求。你希望在 `UserFactory` 中进行检查，如果 `roles` 表中没有记录，就调用 seed 生成默认的角色，否则直接从中选择一个角色。

以下是一个更新后的示例 `UserFactory`，包含了你提出的修改建议：

```php
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->createDefaultRolesIfNeeded();

        // Get random role ID from existing roles
        $roleId = Role::inRandomOrder()->value('id');

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'role_id' => $roleId,
            'remember_token' => Str::random(10),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'date_of_birth' => $this->faker->date,
            'is_verified' => false,
            'verification_token' => Str::random(60),
        ];
    }

    /**
     * Create default roles if needed.
     *
     * @return void
     */
    protected function createDefaultRolesIfNeeded()
    {
        // Check if roles table is empty
        $roleCount = DB::table('roles')->count();

        // If roles table is empty, call the seed to generate default roles
        if ($roleCount === 0) {
            $this->call(RoleSeeder::class);
        }
    }
}
```

通过以上修改，我们在 `UserFactory` 的 `definition` 方法中调用 `createDefaultRolesIfNeeded` 方法，该方法会检查 `roles` 表的记录数。如果表中没有任何记录，我们调用 `RoleSeeder` 来生成默认的角色。

这样，在每次生成用户时，会先检查 `roles` 表，如果没有记录，就会调用 seed 来生成默认角色，否则直接从现有的角色中选择一个。

希望这次的修改满足了你的需求。如果还有其他问题，请随时提问。

