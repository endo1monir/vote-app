<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Voting App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <livewire:styles/>
</head>
<body class="font-sans antialiased">
<header class="flex items-center justify-between px-8 py-4">
    <a href="#"><img src="{{ asset('img/logo.svg') }}" alt="logo"></a>
    <div class="flex items-center">
        @if (Route::has('login'))
            <div class=" px-6 py-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="route('logout')"
                           onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <a href="#">
            <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar"
                 class="w-10 h-10 rounded-full">
        </a>
    </div>

</header>
<main class="container mx-auto flex" style="max-width: 1000px">
    <div style="max-width: 280px;margin-right: 20px">
        <div
            class="bg-white border-2 border-blue rounded-xl mt-16"
            style="
                          border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            border-image-slice: 1;
                            background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            background-origin: border-box;
                            background-clip: content-box, border-box;
                    "
        >
            <div class="text-center px-6 py-2 pt-6">
                <h3 class="font-semibold text-base">Add an idea</h3>
                @auth
                    <p class="text-xs mt-4">Let us know what you would like and we'll take a look over!</p>
                @else
                    <p class="text-xs mt-4">Login first</p>
                @endauth
            </div>
            @auth
             <livewire:create-idea/>
            @else
                <div class="my-6 text-center">
                    <a
                        href="{{ route('login') }}"
                        class="inline-block justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                        <span class="ml-1">Login</span>
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="inline-block justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-4">
                        Sign Up
                    </a>
                </div>
                    @endauth
                </div>
        </div>
        <div style="max-width: 700px">

            <nav class="flex items-center justify-between text-xs">
                <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                    <li><a href="#" class="border-b-4 pb-3 border-blue">All Ideas (87)</a></li>
                    <li><a href="#"
                           class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Considering
                            (6)</a></li>
                    <li><a href="#"
                           class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">In
                            Progress (1)</a></li>
                </ul>

                <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                    <li><a href="#"
                           class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Implemented
                            (10)</a></li>
                    <li><a href="#"
                           class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Closed
                            (55)</a></li>
                </ul>
            </nav>
            <div class="mt-8">
                {{$slot}}
            </div>
        </div>
</main>
<livewire:scripts/>
</body>
</html>
