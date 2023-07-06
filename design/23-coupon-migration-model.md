非常抱歉，我之前的回答没有满足您的要求。以下是修改后的迁移文件和模型代码，以便您在模型中定义枚举字段。

首先是迁移文件 `create_coupons_table.php`：

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
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->timestamps();
            
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
```

接下来是商品模型 `Product.php`：

```php
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // 其他属性和方法...

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
```

然后是订单模型 `Order.php`：

```php
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // 其他属性和方法...

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
```

最后是优惠券模型 `Coupon.php`：

```php
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    const DISCOUNT_TYPE_FIXED = 'fixed';
    const DISCOUNT_TYPE_PERCENTAGE = 'percentage';

    // 其他属性和方法...

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getDiscountTypeOptions()
    {
        return [
            self::DISCOUNT_TYPE_FIXED => 'Fixed Amount',
            self::DISCOUNT_TYPE_PERCENTAGE => 'Percentage',
        ];
    }
}
```

通过以上设置，您可以在模型中定义常量来表示优惠券的折扣类型，同时在模型中添加 `getDiscountTypeOptions()` 方法来返回可选的折扣类型选项。这样，您可以在表单或其他需要使用折扣类型的地方使用这些选项。

请根据您的实际需求和数据结构进行适当的调整和扩展。希望这次回答能满足您的要求。如果还有任何问题，请随时提问。

好的，以下是整合后的代码：

```php
// 创建一个优惠券并与商品关联
$product = Product::find(1);
$coupon = $product->coupons()->create([
    'code' => 'ABC123',
    'discount_amount' => 10.00,
    'discount_type' => 'fixed',
]);

// 创建一个优惠券并与订单关联
$order = Order::find(1);
$coupon = $order->coupons()->create([
    'code' => 'XYZ789',
    'discount_amount' => 5.00,
    'discount_type' => 'percentage',
]);

// 获取商品的优惠券列表
$product = Product::find(1);
$coupons = $product->coupons;

// 获取订单的优惠券列表
$order = Order::find(1);
$coupons = $order->coupons;
```

这样，您可以通过关联关系创建优惠券并与商品或订单进行关联，并获取商品或订单的优惠券列表。

如果您有任何其他问题，请随时提问。
