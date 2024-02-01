<x-app-layout>
    <div class="bg-white shadow dark:bg-gray-800 dark:border-gray-700 ">
        <h2 class="text-4xl font-extrabold dark:text-white text-center my-7">Favourite Books</h2>


        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4  "
            style="height:1100px">

            @foreach ($favourite as $book)
                <div>
                    <img class="rounded-lg bookgrid" src="/images/{{ $book->cover }}" alt="">
                    <h2 class="text-center font-bold text-lg dark:text-white">{{ $book->title }}</h2>
                </div>
            @endforeach

        </div>

        <div class=" grid grid-cols-6  mb-8 place-items-center  mx-6 px-6">
            @if (count($favourite) == 0 || !$favourite)
                <div>
                    <p>No favourite books</p>
                </div>
            @else
                <div>
                    {{ $favourite->links() }}

                </div>

        </div>
        @endif
    </div>
</x-app-layout>
