<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit User - AuctionPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

</head>


<body class="bg-gray-100 text-gray-800">


<div class="min-h-screen flex items-center justify-center p-4">


    <div class="w-full max-w-2xl">


        <div class="mb-6">

            <a href="{{ route('users.index') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-indigo-600 mb-4">

                <i data-lucide="arrow-left" class="w-4 h-4"></i>

                Back to Users

            </a>

            <h1 class="text-3xl font-bold text-gray-900">
                Edit User
            </h1>

            <p class="text-gray-500 mt-1">
                Update user information and role.
            </p>

        </div>


        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">


            @if($errors->any())

                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">

                    <ul class="list-disc list-inside text-sm space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form action="{{ route('users.update', $user) }}" method="POST">

                @csrf

                @method('PUT')


                <!-- NAME -->

                <div class="mb-5">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-500">

                </div>


                <!-- EMAIL -->

                <div class="mb-5">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-500">

                </div>


                <!-- ROLE -->

                <div class="mb-5">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Role
                    </label>

                    <select
                        name="role"
                        required
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-500">

                        <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>
                            Admin
                        </option>

                        <option value="Manager" {{ old('role', $user->role) == 'Manager' ? 'selected' : '' }}>
                            Manager
                        </option>

                        <option value="Staff" {{ old('role', $user->role) == 'Staff' ? 'selected' : '' }}>
                            Staff
                        </option>

                    </select>

                </div>


                <!-- PASSWORD -->

                <div class="mb-5">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Leave blank to keep current password"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-500">

                    <p class="text-xs text-gray-500 mt-2">
                        Leave this field empty if you do not want to change the password.
                    </p>

                </div>


                <!-- CONFIRM -->

                <div class="mb-7">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm new password"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-indigo-500">

                </div>


                <div class="flex flex-col sm:flex-row gap-3">

                    <button
                        type="submit"
                        class="flex-1 bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 font-medium">

                        Update User

                    </button>


                    <a href="{{ route('users.index') }}"
                        class="flex-1 text-center bg-gray-100 text-gray-700 py-3 rounded-xl hover:bg-gray-200 font-medium">

                        Cancel

                    </a>

                </div>


            </form>

        </div>

    </div>

</div>


<script>
    lucide.createIcons();
</script>

</body>

</html>