<x-app-layout>
    <div class="bg-white shadow dark:bg-gray-800 dark:border-gray-700 ">
        <h2 class="text-4xl font-extrabold dark:text-white text-center my-7">All Books</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 items-center justify-between p-4  ">
            <div class="col-start-2">


                <form action="{{ route('user.allbooks') }}" method="GET">
                    <input type="text" id="simple-search" placeholder="Search for Books" name="s"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                    <div class="grid grid-cols-1 mt-1 md:grid-cols-4 gap-4 items-center justify-between ">

                        <div> <select name="filter"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">All</option>
                                <option value="1">Free</option>
                                <option value="2">Bronze</option>
                                <option value="3">Silver</option>
                                <option value="4">Gold</option>



                            </select>

                        </div>
                        <div>
                            <button type="submit"
                                class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Filter</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div
            class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4  ">

            @foreach ($books as $book)
                <div>
                    <img class="rounded-lg bookgrid" src="/images/{{ $book->cover }}" alt="">
                    <a href={{ route('user.showbook', $book->id) }}
                        class="text-center font-bold text-lg dark:text-white ">{{ $book->title }}</a>
                    <p class="dark:text-white">{{ $book->membership->title }}</p>
                </div>
            @endforeach

        </div>

        <div class=" grid grid-cols-3  mb-8 place-items-center  mx-6 px-6">
            @if (count($books) != 0 || !$books)
                <div class="col-start-2">
                    {{ $books->links() }}
                </div>
            @else
                <div class="col-start-2">


                    <p>No Books to show</p>
                </div>
            @endif
        </div>
</x-app-layout>
