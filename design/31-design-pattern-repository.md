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

当使用仓储模式时，你的控制器只依赖于抽象的仓储接口，并不依赖于具体的数据访问实现。这意味着，如果你将来需要更改数据访问逻辑，只需修改仓储类的具体实现，而不需要修改控制器代码。

举一个简单的例子，假设你当前使用的是 Eloquent ORM 来访问数据库，并且你的仓储类是基于 Eloquent ORM 的实现。但是，将来你决定改用其他 ORM 或者存储引擎，比如 Doctrine ORM 或者 MongoDB。在这种情况下，你只需要编写一个新的仓储类，实现新的数据访问逻辑，并且将其绑定到仓储接口。

假设你现在有一个 `UserRepositoryEloquent` 类实现了 `UserRepositoryInterface` 接口，基于 Eloquent ORM。如果你想改用 Doctrine ORM，你可以创建一个新的 `UserRepositoryDoctrine` 类，同样实现 `UserRepositoryInterface` 接口，但是使用 Doctrine ORM 进行数据访问。

在 Laravel 的服务容器绑定中，你只需将绑定指向新的仓储类：

```php
$this->app->bind(UserRepositoryInterface::class, UserRepositoryDoctrine::class);
```

这样，在你的控制器中，你不需要做任何修改。控制器仍然通过依赖注入使用 `UserRepositoryInterface` 接口。通过这种方式，你实现了数据访问逻辑的更改，而不需要修改控制器的代码。

这种解耦的设计使得你可以更加灵活地更改和扩展数据访问逻辑，而不会对其他部分产生影响。你只需关注仓储接口定义和具体的仓储实现，而不必担心对控制器和其他业务逻辑的影响。

总结起来，仓储模式的目的是将数据访问逻辑与其他业务逻辑解耦，使得系统更加灵活、可扩展和可维护。当你需要更改数据访问逻辑时，你只需修改仓储类的具体实现，而不需要修改其他部分的代码。

在 Laravel 中使用仓储模式即使不改变 ORM，仍然有以下优势：

1. 解耦业务逻辑和数据访问逻辑：仓储模式将数据访问逻辑封装在仓储类中，使得业务逻辑层不依赖于具体的数据访问实现。这种解耦使得你可以更加灵活地管理和维护代码。例如，如果你将来决定更换 ORM 或者采用不同的数据访问方式（如缓存），你只需更改仓储类的实现，而不需要修改业务逻辑。

2. 单一职责原则：仓储模式可以确保每个类的职责单一。仓储类专注于处理数据访问操作，而控制器或服务类则负责处理业务逻辑。这样，代码的可读性和可维护性得到了提高。

3. 可测试性：使用仓储模式可以更轻松地进行单元测试和集成测试。因为业务逻辑层不依赖于具体的数据访问实现，你可以使用模拟或者存根来替代真实的仓储类进行测试。这样，你可以更好地隔离测试，确保代码的可靠性和稳定性。

4. 可扩展性：仓储模式提供了良好的扩展性。如果你需要添加新的数据访问操作或者实现缓存层，你可以在仓储类中轻松地添加新的方法或者修改现有方法。这样，你可以根据需求灵活地调整数据访问逻辑，而不影响其他部分的代码。

总的来说，仓储模式在 Laravel 中的优势在于提高代码的可维护性、可测试性和可扩展性。它将数据访问逻辑与业务逻辑解耦，使得代码更加灵活和可管理。尽管在使用相同的 ORM 的情况下，仓储模式仍然可以为你带来许多好处。

当使用仓储模式时，以下是针对 `AuthController` 和 `User` 模型的示例：

1. 解耦业务逻辑和数据访问逻辑：

   在仓储模式中，你可以创建一个名为 `UserRepository` 的仓储类，它负责处理与用户数据的存储和检索相关的操作。通过使用该仓储类，你可以在 `AuthController` 中解耦业务逻辑和数据访问逻辑。

   ```php
   class UserRepository
   {
       public function create(array $data)
       {
           // 创建用户并保存到数据库
       }

       public function findByEmail(string $email)
       {
           // 根据电子邮件查找用户
       }

       // 其他数据访问方法...
   }
   ```

   在 `AuthController` 中，你可以通过依赖注入的方式使用 `UserRepository`：

   ```php
   class AuthController extends Controller
   {
       private $userRepository;

       public function __construct(UserRepository $userRepository)
       {
           $this->userRepository = $userRepository;
       }

       public function register(RegisterRequest $request)
       {
           // ...

           $user = $this->userRepository->create($validatedData);

           // ...
       }

       public function login(LoginRequest $request)
       {
           // ...

           $user = $this->userRepository->findByEmail($credentials['email']);

           // ...
       }
   }
   ```

2. 单一职责原则：

   使用仓储模式后，`AuthController` 负责处理注册和登录的业务逻辑，而 `UserRepository` 负责处理与用户数据的存储和检索相关的操作。这样，每个类都有清晰的职责，代码更具可读性和可维护性。

3. 可测试性：

   由于业务逻辑与数据访问逻辑解耦，你可以在进行单元测试时使用模拟或存根来替代 `UserRepository`，确保只测试业务逻辑的正确性。这样，你可以更好地隔离测试，并确保代码的可靠性。

4. 可扩展性：

   如果你决定更改数据访问逻辑，例如从关系型数据库切换到 NoSQL 数据库，你只需修改 `UserRepository` 的实现，而不需要修改 `AuthController` 中的代码。这样，你可以根据需求灵活地调整数据访问逻辑，而不影响其他部分的代码。

public function login(LoginRequest $request)
{
    $credentials = $request->validated();

    $user = $this->userRepository->findByEmail($credentials['email']);

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        throw ValidationException::withMessages([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    Auth::login($user);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'user' => $user,
        'token' => $token,
    ]);
}
