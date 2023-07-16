下面是一个示例，演示如何在你的控制器中引入仓储模式：

首先，创建一个用户仓储接口 `UserRepositoryInterface`，定义用户相关的数据访问方法：

```php
namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
}
```

接下来，创建一个实现仓储接口的具体类 `UserRepository`，在该类中实现用户数据的创建逻辑：

```php
namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }
}
```

接下来，让控制器依赖于 `UserRepositoryInterface`，并在构造函数中注入具体的仓储实例：

```php
namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        // Validate the user
        $validatedData = $request->validated();

        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Create the user
        $user = $this->userRepository->create($validatedData);

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return the user and token
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    // ...
}
```

最后，将仓储的绑定配置到 Laravel 的服务容器中。可以在 `AppServiceProvider` 的 `register` 方法中添加以下代码：

```php
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;

public function register()
{
    $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
}
```

通过这种方式，你的控制器与具体的数据访问实现解耦，并且可以更轻松地进行测试和扩展。同时，如果你将来需要更改数据访问逻辑，只需修改仓储类的具体实现即可，而不需要修改控制器代码。

请注意，这只是一个简单的示例，你可以根据实际需求扩展和调整仓储模式的实现。仓储模式的具体实现可能因项目的规模和复杂性而有所不同，可以根据项目的需要进行调整。