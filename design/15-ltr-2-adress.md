非常抱歉对先前的回答有误解。以下是添加了以双斜线 `//` 注释的迁移代码：

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // The user ID associated with the address
            $table->string('address'); // The street address
            $table->string('city'); // The city
            $table->string('state'); // The state
            $table->string('country'); // The country
            $table->string('postal_code'); // The postal code
            $table->string('phone_number'); // The phone number
            $table->string('company_name')->nullable(); // The company name (optional)
            $table->string('apartment_number')->nullable(); // The apartment number (optional)
            $table->boolean('is_default')->default(false); // Whether the address is the default address
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
```

请确保根据您的实际需求进行适当的修改和调整。

根据之前的关系，这是生成 Address 模型的示例代码：

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'phone_number',
        'company_name',
        'apartment_number',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Add any other relationships or methods here
}
```

请根据您的实际需求添加任何其他关系或方法。

这是重新生成 Address 模型的完整测试代码，包括创建、更新和删除测试，并添加了英文注释：

```php
namespace Tests\Unit\Models;

use App\Models\Address;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_address()
    {
        $user = User::factory()->create();

        $addressData = [
            'user_id' => $user->id,
            'address' => '123 Main St',
            'city' => 'New York',
            'state' => 'NY',
            'country' => 'USA',
            'postal_code' => '10001',
        ];

        $address = Address::create($addressData);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertDatabaseHas('addresses', $addressData);
    }

    public function test_update_address()
    {
        $address = Address::factory()->create();

        $newData = [
            'address' => '456 Elm St',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'country' => 'USA',
            'postal_code' => '90001',
        ];

        $address->update($newData);

        $this->assertDatabaseHas('addresses', $newData);
    }

    public function test_delete_address()
    {
        $address = Address::factory()->create();

        $address->delete();

        $this->assertSoftDeleted('addresses', ['id' => $address->id]);
    }

    public function test_belongs_to_user()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $address->user);
        $this->assertEquals($user->id, $address->user->id);
    }

    public function test_has_many_carts()
    {
        $address = Address::factory()->create();
        $cart1 = Cart::factory()->create(['address_id' => $address->id]);
        $cart2 = Cart::factory()->create(['address_id' => $address->id]);

        $this->assertInstanceOf(Cart::class, $address->carts->first());
        $this->assertCount(2, $address->carts);
    }

    // Add any other tests here
}
```

请根据您的实际需求添加任何其他测试。
