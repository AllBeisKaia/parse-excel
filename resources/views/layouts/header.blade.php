<header>
    <nav class="bg-white border-gray-200 px-4 p-6 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('home') }}" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Home</span>
            </a>
            <parser-bar></parser-bar>
            <div class="flex items-center lg:order-2">
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right bg-white border-gray-200 dark:bg-gray-800 rounded-bl-lg">
                    @guest
                        <a class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                           href="{{ route('loginForm') }}"
                        >Log in</a>
                        <a class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                           href="{{ route('registerForm') }}"
                        >Register</a>
                    @endguest
                    @auth
                        <a class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                           href="{{ route('parser.parserForm') }}"
                        >Parse</a>
                        <a class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                           href="{{ route('logout') }}"
                        >Log out</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
