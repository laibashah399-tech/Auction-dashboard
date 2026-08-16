<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - AuctionPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                    }
                }
            }
        }
    </script>

</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">

        <!-- Logo -->

        <div class="text-center mb-8">

            <div class="inline-flex items-center justify-center
                        w-16 h-16 bg-indigo-600
                        rounded-2xl text-white mb-4">

                <i data-lucide="gavel" class="w-8 h-8"></i>

            </div>

            <h1 class="text-2xl font-bold text-gray-900">
                AuctionPro
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Management System
            </p>

        </div>


        <!-- Login Card -->

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

            <div class="mb-6">

                <h2 class="text-2xl font-bold text-gray-900">
                    Welcome Back
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Sign in to access your admin dashboard.
                </p>

            </div>


            <!-- Success Message -->

            @if(session('success'))

                <div class="mb-5 p-4 rounded-xl
                            bg-green-50 border border-green-200
                            text-green-700 text-sm">

                    {{ session('success') }}

                </div>

            @endif


            <!-- Login Form -->

            <form method="POST" action="{{ route('login.submit') }}">

                @csrf


                <!-- Email -->

                <div class="mb-5">

                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700 mb-2">

                        Email Address

                    </label>

                    <div class="relative">

                        <i data-lucide="mail"
                           class="absolute left-3 top-1/2
                                  -translate-y-1/2
                                  w-5 h-5 text-gray-400">
                        </i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="admin@example.com"
                            required
                            autofocus
                            class="w-full pl-11 pr-4 py-3
                                   border border-gray-200
                                   rounded-xl
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-indigo-500
                                   focus:border-transparent">

                    </div>

                    @error('email')

                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <!-- Password -->

                <div class="mb-5">

                    <label
                        for="password"
                        class="block text-sm font-medium text-gray-700 mb-2">

                        Password

                    </label>

                    <div class="relative">

                        <i data-lucide="lock"
                           class="absolute left-3 top-1/2
                                  -translate-y-1/2
                                  w-5 h-5 text-gray-400">
                        </i>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            class="w-full pl-11 pr-4 py-3
                                   border border-gray-200
                                   rounded-xl
                                   focus:outline-none
                                   focus:ring-2
                                   focus:ring-indigo-500
                                   focus:border-transparent">

                    </div>

                    @error('password')

                        <p class="text-sm text-red-600 mt-2">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                <!-- Remember -->

                <div class="flex items-center justify-between mb-6">

                    <label class="flex items-center gap-2">

                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="w-4 h-4 text-indigo-600
                                   border-gray-300 rounded">

                        <span class="text-sm text-gray-600">
                            Remember me
                        </span>

                    </label>

                </div>


                <!-- Login Button -->

                <button
                    type="submit"
                    class="w-full flex items-center
                           justify-center gap-2
                           bg-indigo-600 text-white
                           py-3 rounded-xl
                           font-semibold
                           hover:bg-indigo-700
                           transition">

                    <i data-lucide="log-in" class="w-5 h-5"></i>

                    Sign In

                </button>

            </form>

        </div>


        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} AuctionPro. All rights reserved.
        </p>

    </div>


    <script>
        lucide.createIcons();
    </script>

</body>

</html>