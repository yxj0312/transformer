<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100">

    <!-- Navigation Bar -->
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-white text-2xl font-bold">Logo</div>
            <div class="flex space-x-4">
                <a href="#" class="text-white">Home</a>
                <a href="#" class="text-white">Products</a>
                <a href="#" class="text-white">About Us</a>
                <a href="#" class="text-white">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-gray-900 text-white py-16 px-8">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to Our Online Store</h1>
            <p class="text-lg mb-8">Find the best deals and shop with confidence.</p>
            <a href="#" class="bg-blue-500 text-white py-3 px-6 rounded-md hover:bg-blue-600 transition duration-300">Shop Now</a>
        </div>
    </header>

    <!-- Featured Products -->
    <section class="py-16">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-8">Featured Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Product Card -->
                <div class="bg-white p-4 shadow-md">
                    <img src="product1.jpg" alt="Product 1" class="w-full h-48 object-cover mb-4">
                    <h3 class="text-lg font-bold">Product 1</h3>
                    <p class="text-gray-500">Description of Product 1</p>
                    <div class="text-red-500 font-bold">$19.99</div>
                    <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Add to Cart</button>
                </div>

                <!-- Add more product cards here -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto text-center">
            &copy; 2023 Online Store. All rights reserved.
        </div>
    </footer>

</body>
</html>
