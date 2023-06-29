**OrderTest.php**

```php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a payment method
        $paymentMethod = PaymentMethod::factory()->create();

        // Create an order status
        $orderStatus = OrderStatus::factory()->create();

        // Create an order
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $paymentMethod->id,
            'status_id' => $orderStatus->id,
            'total_amount' => 100.00,
            'currency' => 'USD',
            'shipping_address' => '123 Shipping St, City, Country',
            'billing_address' => '456 Billing St, City, Country',
        ]);

        $this->assertInstanceOf(Order::class, $order);
        // Assert other attributes and relationships
    }

    public function test_update_order()
    {
        // Create an order
        $order = Order::factory()->create();

        // Update the order
        $order->update([
            'total_amount' => 200.00,
            'currency' => 'EUR',
            // Update other attributes
        ]);

        // Assert the order has been updated
        $this->assertEquals(200.00, $order->total_amount);
        // Assert other attributes
    }

    public function test_delete_order()
    {
        // Create an order
        $order = Order::factory()->create();

        // Delete the order
        $order->delete();

        // Assert the order has been soft deleted
        $this->assertSoftDeleted($order);
    }

    public function test_order_user_relationship()
    {
        // Create an order and associate a user
        $order = Order::factory()->create();
        $user = User::factory()->create();
        $order->user()->associate($user);

        // Assert the relationship between order and user
        $this->assertEquals($user->id, $order->user->id);
    }

    public function test_order_payment_method_relationship()
    {
        // Create an order and associate a payment method
        $order = Order::factory()->create();
        $paymentMethod = PaymentMethod::factory()->create();
        $order->paymentMethod()->associate($paymentMethod);

        // Assert the relationship between order and payment method
        $this->assertEquals($paymentMethod->id, $order->paymentMethod->id);
    }

    public function test_order_status_relationship()
    {
        // Create an order and associate an order status
        $order = Order::factory()->create();
        $orderStatus = OrderStatus::factory()->create();
        $order->orderStatus()->associate($orderStatus);

        // Assert the relationship between order and order status
        $this->assertEquals($orderStatus->id, $order->orderStatus->id);
    }

    public function test_order_products_relationship()
    {
        // Create an order
        $order = Order::factory()->create();

        // Create multiple products and associate them with the order
        $products = Product::factory()->count(3)->create();
        $order->products()->attach($products, ['quantity' => 1]);

        // Assert the relationship between order and products
        $this->assertCount(3, $order->products);
    }
}
```

**OrderStatusTest.php**

```php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order

_status()
    {
        // Create an order status
        $orderStatus = OrderStatus::create([
            'name' => 'Pending',
            'description' => 'Order is pending',
            'slug' => 'pending',
            // Add other attributes
        ]);

        $this->assertInstanceOf(OrderStatus::class, $orderStatus);
        // Assert other attributes and relationships
    }

    public function test_update_order_status()
    {
        // Create an order status
        $orderStatus = OrderStatus::factory()->create();

        // Update the order status
        $orderStatus->update([
            'name' => 'Updated Status',
            // Update other attributes
        ]);

        // Assert the order status has been updated
        $this->assertEquals('Updated Status', $orderStatus->name);
        // Assert other attributes
    }

    public function test_delete_order_status()
    {
        // Create an order status
        $orderStatus = OrderStatus::factory()->create();

        // Delete the order status
        $orderStatus->delete();

        // Assert the order status has been soft deleted
        $this->assertSoftDeleted($orderStatus);
    }

    public function test_order_status_orders_relationship()
    {
        // Create an order status and associate orders
        $orderStatus = OrderStatus::factory()->create();
        $orders = Order::factory()->count(3)->create(['status_id' => $orderStatus->id]);

        // Assert the relationship between order status and orders
        $this->assertCount(3, $orderStatus->orders);
    }
}
```

**PaymentMethodTest.php**

```php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_payment_method()
    {
        // Create a payment method
        $paymentMethod = PaymentMethod::create([
            'name' => 'Credit Card',
            // Add other attributes
        ]);

        $this->assertInstanceOf(PaymentMethod::class, $paymentMethod);
        // Assert other attributes and relationships
    }

    public function test_update_payment_method()
    {
        // Create a payment method
        $paymentMethod = PaymentMethod::factory()->create();

        // Update the payment method
        $paymentMethod->update([
            'name' => 'Updated Payment Method',
            // Update other attributes
        ]);

        // Assert the payment method has been updated
        $this->assertEquals('Updated Payment Method', $paymentMethod->name);
        // Assert other attributes
    }

    public function test_delete_payment_method()
    {
        // Create a payment method
        $paymentMethod = PaymentMethod::factory()->create();

        // Delete the payment method
        $paymentMethod->delete();

        // Assert the payment method has been soft deleted
        $this->assertSoftDeleted($paymentMethod);
    }

    public function test_payment_method_orders_relationship()
    {
        // Create a payment method and associate orders
        $paymentMethod = PaymentMethod::factory()->create();
        $orders = Order::factory()->count(3)->create(['payment_method_id' => $paymentMethod->id]);

        // Assert the relationship between payment method and orders
        $this->assertCount(3, $paymentMethod->orders);
    }
}
```

请确保在运行测试之前执行数据库迁移以创建相关表结构。您可以根据需要自定义每个测试用例的断言和测试数据。

**OrderFactory.php**

```php
use App\Models\Order;
use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'order_status_id' => OrderStatus::factory(),
            'total_amount' => $this->faker->randomFloat(2, 10, 100),
            'currency' => $this->faker->currencyCode,
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'shipping_method' => $this->faker->randomElement(['express', 'standard']),
            'tracking_number' => $this->faker->optional()->numberBetween(100000, 999999),
            'shipping_address' => $this->faker->optional()->address,
            'billing_address' => $this->faker->optional()->address,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}

```

**OrderStatusFactory.php**

```php
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderStatusFactory extends Factory
{
    protected $model = OrderStatus::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'is_default' => $this->faker->boolean,
            'is_active' => $this->faker->boolean,
        ];
    }
}
```

**PaymentMethodFactory.php**

```php
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            // Add other attributes
        ];
    }
}
```

以上是使用 Laravel 9 的工厂文件示例。请确保将这些工厂文件放置在适当的位置，并根据需要自定义工厂数据。
