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
                <!-- User Registration Button -->
                <button class="text-white" @click="showRegistrationModal">Register</button>
                <!-- User Login Button -->
                <button class="text-white" @click="showLoginModal">Login</button>
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

    <!-- User Registration Modal -->
    <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50" v-if="showRegistration">
        <div class="bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-4">User Registration</h2>
            <!-- Registration form -->
            <form @submit.prevent="registerUser">
                <input type="text" v-model="name" placeholder="Name" class="w-full mb-2 p-2 border border-gray-300 rounded">
                <input type="email" v-model="email" placeholder="Email" class="w-full mb-2 p-2 border border-gray-300 rounded">
                <input type="password" v-model="password" placeholder="Password" class="w-full mb-4 p-2 border border-gray-300 rounded">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Register</button>
                <button @click="closeRegistrationModal" class="ml-2 py-2 px-4 border rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- User Login Modal -->
    <div class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-900 bg-opacity-50" v-if="showLogin">
        <div class="bg-white p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-4">User Login</h2>
            <!-- Login form -->
            <form @submit.prevent="loginUser">
                <input type="email" v-model="loginEmail" placeholder="Email" class="w-full mb-2 p-2 border border-gray-300 rounded">
                <input type="password" v-model="loginPassword" placeholder="Password" class="w-full mb-4 p-2 border border-gray-300 rounded">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-300">Login</button>
                <button @click="closeLoginModal" class="ml-2 py-2 px-4 border rounded">Cancel</button>
            </form>
        </div>
    </div>

    <!-- User Avatar (Placeholder) -->
    <div class="fixed top-0 right-0 m-4 p-2 bg-blue-500 text-white rounded-full cursor-pointer" @click="showUserDropdown">
        <!-- Add a user avatar image here or use a font icon (e.g., fontawesome) -->
        User
    </div>

    <!-- User Dropdown (Placeholder) -->
    <div class="fixed top-0 right-0 mt-16 w-40 bg-white border rounded shadow-md" v-if="showUserDropdown">
        <ul>
            <!-- Add user-related dropdown options here (e.g., My Account, Logout) -->
            <li class="px-4 py-2 hover:bg-gray-100">My Account</li>
            <li class="px-4 py-2 hover:bg-gray-100">Logout</li>
        </ul>
    </div>

    <script src="https://unpkg.com/vue@next"></script>
    <script>
        const app = Vue.createApp({
            data() {
                return {
                    showRegistration: false,
                    showLogin: false,
                    name: '',
                    email: '',
                    password: '',
                    loginEmail: '',
                    loginPassword: '',
                    showUserDropdown: false,
                };
            },
            methods: {
                showRegistrationModal() {
                    this.showRegistration = true;
                },
                closeRegistrationModal() {
                    this.showRegistration = false;
                },
                registerUser() {
                    // Implement user registration logic here
                    // For demonstration purposes, we'll just close the modal
                    this.closeRegistrationModal();
                },
                showLoginModal() {
                    this.showLogin = true;
                },
                closeLoginModal() {
                    this.showLogin = false;
                },
                loginUser() {
                    // Implement user login logic here
                    // For demonstration purposes, we'll just close the modal
                    this.closeLoginModal();
                },
                showUserDropdown() {
                    this.showUserDropdown = !this.showUserDropdown;
                },
            },
        }).mount('#app');
    </script>
</body>
</html>
