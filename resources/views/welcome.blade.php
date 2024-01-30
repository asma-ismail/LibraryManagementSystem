<x-app-layout>


    <section class="bg-center bg-no-repeat bg-[url('/imgs/books-home.jpg')] bg-gray-700 bg-blend-multiply">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                Explore Boundless Adventures</h1>
            <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Dive into a world of
                captivating stories, literary masterpieces, and the latest bestsellers. Discover new realms, meet
                intriguing characters, and embark on unforgettable journeys—all from the comfort of your favorite
                reading nook.


            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="{{ route('register') }}"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-950 hover:bg-blue-950 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Free Registeration
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>

            </div>
        </div>
    </section>
    <div class="mt-7">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Latest Books
        </h2>
        <p class="mb-8 lg:mb-16 font-light text-center text-gray-500 dark:text-gray-400 sm:text-xl">Et fugiat aliquip
            voluptate est et pariatur id qui. Dolor exercitation elit
            sunt.
        </p>
    </div>
    <div
        class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4  ">

        @foreach ($books as $book)
            <div>
                <img class="rounded-lg bookgrid" src="/images/{{ $book->cover }}" alt="">
                <a href={{ route('register', [$book->id]) }}
                    class="text-center font-bold text-lg">{{ $book->title }}</a>
            </div>
        @endforeach

    </div>

</x-app-layout>
