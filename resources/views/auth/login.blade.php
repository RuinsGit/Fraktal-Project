<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        .loader {
            position: fixed;
            inset: 0;
            z-index: 9999;
            transition: 0.3s ease-out;
        }
    </style>
</head>
<body class="font-inter">
    <!-- Loading Screen -->
    <div class="loader bg-white flex items-center justify-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
    </div>

    <div class="min-h-screen flex">
        <!-- Login Form Side -->
        <div class="flex-1 flex items-center justify-center bg-gray-50 px-4 sm:px-6 lg:flex-none lg:w-[480px]">
            <div class="w-full max-w-sm">
                <!-- Logo & Header -->
                <div class="mb-10">
                    <img class="h-12 w-auto mb-8" style="width: 100px; height: 70px;" src="{{ asset('back/assets/images/logo.webp') }}" alt="Logo">
                    <h2 class="text-2xl font-bold text-gray-900">Admin Panel</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Xoş gəlmisiniz! Zəhmət olmasa məlumatlarınızı daxil edin.
                    </p>
                </div>

                <!-- Login Form -->
                <form action="{{ route('admin.handle-login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Email
                        </label>
                        <div class="mt-1 relative">
                            <input type="email" name="email" 
                                class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm 
                                placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @if($errors->first('email'))
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Şifrə
                        </label>
                        <div class="mt-1 relative">
                            <input type="password" name="password" 
                                class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm 
                                placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @if($errors->first('password'))
                                <p class="mt-1 text-sm text-red-600">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm 
                            text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 
                            focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            Daxil Ol
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side Banner -->
        <div class="hidden lg:flex flex-1 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-indigo-900"></div>
            <div class="absolute inset-0 bg-grid-white/[0.2] bg-[length:16px_16px]"></div>
            <div class="relative flex items-center justify-center">
                <div class="max-w-2xl text-center text-white space-y-8">
                    <h1 class="text-4xl font-bold">Admin Panelinə Xoş Gəlmisiniz</h1>
                    <p class="text-lg text-blue-100">
                        Sistemin idarə edilməsi üçün nəzərdə tutulmuş admin panelinə daxil olmaq üçün məlumatlarınızı daxil edin.
                    </p>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 -mt-32 -mr-32 w-96 h-96 rounded-full bg-blue-500 opacity-20 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-32 -ml-32 w-96 h-96 rounded-full bg-indigo-500 opacity-20 blur-3xl"></div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const loader = document.querySelector('.loader');
            loader.style.opacity = '0';
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300);
        });
    </script>
</body>
</html>
