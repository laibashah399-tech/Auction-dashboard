<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Details - AuctionPro</title>

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
                User Details
            </h1>

        </div>


        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8">


            <div class="flex flex-col items-center text-center mb-8">


                <div class="w-20 h-20 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-2xl font-bold mb-4">

                    {{ strtoupper(substr($user->name, 0, 2)) }}

                </div>


                <h2 class="text-2xl font-bold">
                    {{ $user->name }}
                </h2>


                <p class="text-gray-500 mt-1">
                    {{ $user->email }}
                </p>


                <span class="mt-3 inline-flex px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-sm font-medium">

                    {{ $user->role }}

                </span>

            </div>


            <div class="border-t border-gray-100 pt-6 space-y-5">


                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Name
                    </span>

                    <span class="font-medium">
                        {{ $user->name }}
                    </span>

                </div>


                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Email
                    </span>

                    <span class="font-medium">
                        {{ $user->email }}
                    </span>

                </div>


                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Role
                    </span>

                    <span class="font-medium">
                        {{ $user->role }}
                    </span>

                </div>


                <div class="flex justify-between">

                    <span class="text-gray-500">
                        Joined
                    </span>

                    <span class="font-medium">
                        {{ $user->created_at?->format('d M Y, h:i A') }}
                    </span>

                </div>


            </div>


            <div class="flex gap-3 mt-8">


                <a href="{{ route('users.edit', $user) }}"
                    class="flex-1 text-center bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700">

                    Edit User

                </a>


                <a href="{{ route('users.index') }}"
                    class="flex-1 text-center bg-gray-100 text-gray-700 py-3 rounded-xl hover:bg-gray-200">

                    Back

                </a>

            </div>


        </div>

    </div>

</div>


<script>
    lucide.createIcons();
</script>

</body>

</html>