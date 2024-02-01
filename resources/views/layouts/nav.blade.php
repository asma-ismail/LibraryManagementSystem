<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/images/logo-1.png" class="h-8" alt="My Book Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">My Bookstore</span>
        </a>
        <button data-collapse-toggle="navbar-default" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route('home') }}"
                        class="block  text-white {{ Route::currentRouteNamed('home') ? 'bg-blue-100' : 'hover:bg-blue-100' }} px-2 rounded md:text-blue-950  dark:text-white md:dark:text-blue-500"
                        aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#"
                        class="block  text-white {{ Route::currentRouteNamed('about') ? 'bg-blue-100' : 'hover:bg-blue-100' }} px-2 rounded md:text-blue-950  dark:text-white md:dark:text-blue-500">About</a>
                </li>
                <li>
                    <a href="{{ auth()->check() ? route('user.allbooks') : route('books') }}"
                        class="block  text-white {{ Route::currentRouteNamed('books') || Route::currentRouteNamed('user.allbooks') ? 'bg-blue-100' : 'hover:bg-blue-100' }} px-2 rounded md:text-blue-950  dark:text-white md:dark:text-blue-500">Books</a>
                </li>
                <li>
                    <a href="{{ route('pricing') }}"
                        class="block  text-white {{ Route::currentRouteNamed('pricing') ? 'bg-blue-100' : 'hover:bg-blue-100' }} px-2 rounded md:text-blue-950  dark:text-white md:dark:text-blue-500">Pricing</a>
                </li>
                <li>
                    <a href="{{ route('contactus') }}"
                        class="block  text-white {{ Route::currentRouteNamed('contactus') ? 'bg-blue-100' : 'hover:bg-blue-100' }} px-2 rounded md:text-blue-950  dark:text-white md:dark:text-blue-500">Contact</a>
                </li>


                </li>

            </ul>
            @if (Route::has('login'))
                <div class=" sm:top-7 sm:right-8 fixed lg:right-0 lg:top-8 lg:m-6 text-right z-10">
                    @auth
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>


                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />

                                            </svg>
                                        </div>
                                    </button>

                                </x-slot>


                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('user.books')">
                                        {{ __('Favourite books') }}
                                    </x-dropdown-link>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>


    </div>
</nav>
