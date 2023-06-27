非常抱歉之前的错误。以下是根据我们之前的讨论重新生成的 Orders、PaymentMethod 和 OrderStatus 表的迁移和模型，并添加了软删除和英文注释，包括所有的关联关系：

创建 Orders 表的迁移和模型：

Migration:

```php
php artisan make:migration create_orders_table --create=orders
```

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('order_status_id');
            $table->decimal('total_amount', 10, 2)->comment('The total amount of the order');
            $table->string('currency')->comment('The currency of the order');
            $table->string('payment_status')->comment('The payment status of the order');
            $table->string('shipping_method')->comment('The shipping method of the order');
            $table->string('tracking_number')->nullable()->comment('The tracking number of the order');
            $table->text('shipping_address')->nullable()->comment('The shipping address of the order');
            $table->text('billing_address')->nullable()->comment('The billing address of the order');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
```

Model:

```php
php artisan make:model Order
```

```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'payment_method_id',
        'order_status_id',
        'total_amount',
        'currency',
        'payment_status',
        'shipping_method',
        'tracking_number',
        'shipping_address',
        'billing_address',
    ];

    /**
     * Get the user that placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payment method of the order.
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the status of the order.
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    /**
     * Get the products in the order.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity');
    }
}
```

创建 PaymentMethods 表的迁移和模型：

Migration:

```php
php artisan make:migration create_payment_methods_table --create=payment_methods
```

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('gateway')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}

```

Model:

```php
php artisan make:model PaymentMethod
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'gateway',
        'is_active',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

```

创建 OrderStatuses 表的迁移和模型：

Migration:

```php
php artisan make:migration create_order_statuses_table --create=order_statuses
```

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}

```

Model:

```php
php artisan make:model OrderStatus
```

```php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStatus extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

```

请运行相应的迁移命令来创建表结构。
