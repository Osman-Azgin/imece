<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>İmece</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite('resources/css/app.css')
</head>
<body class="antialiased">
<div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            @auth
                <a href="{{ url('/dashboard') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __("Dashboard") }}</a>
            @else
                <a href="{{ route('login') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __("Log in") }}</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __("Register") }}</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="p-6 lg:p-8">
        <div class="flex justify-center">
            <svg style="width: 175px;height: 48px;" viewBox="317 48" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient gradientUnits="userSpaceOnUse" x1="25.688" y1="8.116" x2="25.688" y2="39.961"
                                    id="gradient-0"
                                    gradientTransform="matrix(1.194104, 0, 0, 1.204525, -2.732946, -6.030062)">
                        <stop offset="0" style="stop-color: rgb(216, 85, 218);"></stop>
                        <stop offset="1" style="stop-color: rgb(90, 36, 165);"></stop>
                    </linearGradient>
                </defs>
                <text style="fill: rgb(56, 20, 92); font-family: Caladea; font-size: 34px; white-space: pre;" x="72.256"
                      y="35.055">İMECE
                </text>
                <rect x="7.569" y="3.745" width="40.743" height="38.358" style="fill: url(#gradient-0);" rx="1.76"
                      ry="1.76"></rect>
                <path style="fill: rgb(180, 85, 218); stroke: rgb(255, 255, 255);"
                      d="M -6.917 17.444 L 7.268 16.836 L 15.115 11.965 C 15.115 11.965 27.045 6.806 28.092 11.05 C 28.86 14.16 18.163 13.74 19.382 14.954 C 22.492 18.052 38.502 10.687 40.87 15.285 C 43.217 19.843 13.579 21.496 42.632 18.673 C 43.444 18.593 45.274 21.973 42.848 23.165 C 39.8 24.661 32.223 24.053 32.223 24.053 C 32.223 24.053 40.159 23.776 42.186 26.745 C 43.245 28.297 44.069 28.359 42.605 29.394 C 39.612 31.51 32.241 27.972 32.241 27.972 C 32.241 27.972 42.031 32.604 39.408 34.476 C 37.455 35.87 28.91 31.861 20.102 31.166 C 7.802 30.195 -5.407 32.057 -5.407 32.057"></path>
            </svg>
        </div>
        <h1 class="mt-6 text-xl text-center">{{ __('Requirements') }}</h1>
        <div class="mt-6" style="min-height: 60vh;">
            @foreach($currentRequirements as $requirement)
            {{--
            <div class="w-full bg-white p-4 md:p-8 grid grid-cols-4 gap-4 rounded-lg justify-center items-center">
                <div class="col-span-1 flex">
                    <svg style="width: 50px;color: purple;" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="50 50" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                    </svg>

                    {{ $requirement->inkindDonation->name }}
                </div>
                <div class="col-span-1">
                    {{ $requirement->warehouse->team->name }}
                </div>
                <div class="col-span-2 text-right">
                    {{ $requirement->warehouse->address->district->name }}
                    /{{ $requirement->warehouse->address->city->name }}
                </div>
            </div> --}}
                <div class="w-full p-3 md:p-6 grid grid-cols-4 md:grid-cols-5 gap-4 md:gap-2 bg-white rounded-lg items-center justify-center pl-1 mb-6">
                    <div class="flex items-start justify-start h-full col-span-2">
                        <svg style="width: 40px;height:40px;color:purple;margin-right: 15px;"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                        </svg>
                        {{ $requirement->inkindDonation->name }}
                    </div>
                    <div class="flex items-start justify-start h-full col-span-2 md:col-span-1">
                        <svg style="width: 30px;height:30px;color:purple;margin-right: 15px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <div>
                            {{ $requirement->warehouse->team->name }}<br>
                            {{ $requirement->warehouse->name }} Deposu
                        </div>
                    </div>
                    <div class="flex justify-between md:justify-end h-full col-span-4 md:col-span-2 pl-2">
                        <div>
                            {{ $requirement->warehouse->address->street->name }}<br>
                            {{ $requirement->warehouse->address->district->name }}
                            /{{ $requirement->warehouse->address->city->name }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
            <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                <div class="flex items-center gap-4">
                    <a href="https://github.com/sponsors/taylorotwell"
                       class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             class="-mt-px mr-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
                        </svg>
                        Sponsor
                    </a>
                </div>
            </div>

            <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </div>
</div>
</body>
</html>
