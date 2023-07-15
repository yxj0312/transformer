当将验证逻辑放入单独的请求类中时，可以使用 Laravel 提供的表单请求验证功能。下面是完整的代码：

首先，创建一个新的表单请求类，命名为 `RegisterRequest`：

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
        ];
    }
}
```

接下来，创建另一个表单请求类，命名为 `LoginRequest`：

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
}
```

修改 `AuthController`，使用 `RegisterRequest` 和 `LoginRequest` 进行验证：

```php
namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        $user = $request->user();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
}
```

现在，验证逻辑被移动到 `RegisterRequest` 和 `LoginRequest` 类中，并通过 `validated()` 方法获取验证通过的数据。

请确保 `RegisterRequest` 和 `LoginRequest` 类被创建在 `app/Http/Requests` 目录下，并与示例代码的命名空间一致。

希望这次的代码能满足你的需求。如果还有其他问题，请随时提问。