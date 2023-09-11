## Middleware

To check the API token stored in the local storage each time a user logs in, you can create a custom middleware in your Laravel project. This middleware will inspect the token in the request and validate it against your authentication logic. If the token is valid, the user is authenticated.

Here's how you can create a custom middleware for this purpose:

1. Create a new middleware using the following Artisan command:

   ```bash
   php artisan make:middleware ApiTokenCheck
   ```

   This will create a new middleware file named `ApiTokenCheck.php` in the `app/Http/Middleware` directory.

2. Open the `ApiTokenCheck.php` file and modify the `handle` method to check the API token in the request:

   ```php
   <?php

   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;

   class ApiTokenCheck
   {
       public function handle(Request $request, Closure $next)
       {
           // Check if the API token is present in the request headers or local storage
           $apiToken = $request->header('Authorization') ?: $request->input('api_token');

           if (!$apiToken) {
               return response()->json(['message' => 'Unauthorized'], 401);
           }

           // Perform your token validation logic here
           // You may validate the token against your database or other authentication service

           // If the token is valid, continue with the request
           return $next($request);
       }
   }
   ```

   In this middleware, we check if the API token is present in the request headers (`Authorization` header) or as a request parameter (`api_token`). You can adjust this logic based on how you send the token from your frontend. If the token is missing or invalid, it returns a 401 Unauthorized response. You should implement your own token validation logic inside the middleware.

3. Register your custom middleware in the `$routeMiddleware` array in the `app/Http/Kernel.php` file:

   ```php
   protected $routeMiddleware = [
       // Other middleware...
       'api.token.check' => \App\Http\Middleware\ApiTokenCheck::class,
   ];
   ```

4. Apply the `api.token.check` middleware to the routes where you want to check the API token:

   ```php
   Route::middleware('api.token.check')->group(function () {
       // These routes will check the API token
   });
   ```

   Now, when you access routes within this group, the `ApiTokenCheck` middleware will run and check the API token sent with the request.

Remember to customize the token validation logic inside the middleware according to your specific requirements, such as verifying the token against your database or other authentication service.

## Test

Certainly! To test the custom `ApiTokenCheck` middleware, you can create a test case using Laravel's testing features. Here's an example of how you can create a test for this middleware:

Assuming you have created the `ApiTokenCheck` middleware as mentioned earlier, you can create a test case to ensure that it correctly checks the API token.

1. Create a test case class if you don't already have one:

   ```bash
   php artisan make:test ApiTokenCheckTest
   ```

   This will create a new test file named `ApiTokenCheckTest.php` in the `tests/Feature` directory.

2. Open the `ApiTokenCheckTest.php` file and write a test for the middleware. You can create test methods for both authorized and unauthorized scenarios:

   ```php
   <?php

   namespace Tests\Feature;

   use Illuminate\Foundation\Testing\RefreshDatabase;
   use Illuminate\Foundation\Testing\WithFaker;
   use Tests\TestCase;

   class ApiTokenCheckTest extends TestCase
   {
       /** @test */
       public function it_passes_with_valid_api_token()
       {
           // Create a user and generate a valid API token for testing
           $user = factory(User::class)->create();
           $token = $user->createToken('test-token')->plainTextToken;

           $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                            ->get('/api/protected-route');

           $response->assertStatus(200); // Ensure the route returns a success status
       }

       /** @test */
       public function it_fails_with_missing_api_token()
       {
           $response = $this->get('/api/protected-route');

           $response->assertStatus(401); // Ensure the route returns a 401 Unauthorized status
       }
   }
   ```

   In the `it_passes_with_valid_api_token` method, we create a user, generate a valid API token for that user, and then make a request to a protected route with the valid token. We expect the route to return a success status (e.g., 200).

   In the `it_fails_with_missing_api_token` method, we make a request to the same protected route without including the API token. We expect the route to return a 401 Unauthorized status.

3. Make sure to adjust the route and logic in the test methods to match your actual application.

4. Run the tests:

   ```bash
   php artisan test
   ```

   This will execute the test methods you defined in the `ApiTokenCheckTest` class and provide you with the test results.

These tests will help ensure that your `ApiTokenCheck` middleware correctly checks API tokens and returns the expected responses for authorized and unauthorized requests.
