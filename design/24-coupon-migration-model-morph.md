非常抱歉之前的回答没有完全满足您的需求。以下是根据您的要求重新整合的代码示例：

首先，对于 `coupons` 表的迁移文件，您可以使用以下代码：

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount_amount', 10, 2);
            $table->string('discount_type');
            $table->unsignedBigInteger('couponable_id');
            $table->string('couponable_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
```

然后，在 `Coupon` 模型中定义多态关联方法以及其他属性和方法：

```php
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public const DISCOUNT_TYPE_FIXED = 'fixed';
    public const DISCOUNT_TYPE_PERCENTAGE = 'percentage';

    protected $fillable = [
        'code', 'discount_amount', 'discount_type'
    ];

    public function couponable()
    {
        return $this->morphTo();
    }

    // 其他属性和方法...
}
```

接下来，您可以在商品（Product）模型中定义多态关联的方法以及其他属性和方法：

```php
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // 其他属性和方法...

    public function coupons()
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }
}
```

在订单（Order）模型中也定义多态关联的方法以及其他属性和方法：

```php
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // 其他属性和方法...

    public function coupons()
    {
        return $this->morphMany(Coupon::class, 'couponable');
    }
}
```

现在，您可以使用以下示例代码来创建优惠券并将其与商品或订单关联：

```php
// 创建一个优惠券并与商品关联
$product = Product::find(1);
$product->coupons()->create([
    'code' => 'ABC123',
    'discount_amount' => 10.00,
    'discount_type' => Coupon::DISCOUNT_TYPE_FIXED,
]);

// 创建一个优惠券并与订单关联
$order = Order::find(1);
$order->coupons()->create([
    'code' => 'XYZ789',
    'discount_amount' => 5.00,
    'discount_type' => Coupon::DISCOUNT_TYPE_PERCENTAGE,
]);

// 获取商品的优惠券列表
$product = Product::find(1);
$coupons = $product->coupons;

// 获取订单的优惠券列表
$order = Order::find(1);
$coupons = $order->coupons;
```

以上代码示例可以让您创建优惠券并将其与商品或订单进行关联，以及获取相关模型的优惠券列表。

如果还有任何疑问，请随时提问。