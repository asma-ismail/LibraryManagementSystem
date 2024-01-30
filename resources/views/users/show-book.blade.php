<x-app-layout>
    <div class="grid grid-cols-10">




        <div
            class="col-start-4   col-span-4 grid grid-cols-10 items-center justify-between  p-8    bg-white border border-gray-200 rounded-lg shadow ">

            <div class="col-start-1 col-span-3">

                <img class="object-cover w-full rounded-t-lg h-96 w-48 " src="/images/{{ $book->cover }}" alt="">

            </div>
            <div class="col-span-6 justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $book->title }}
                </h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $book->description }}</p>
                <p>Membership: {{ $book->membership->title }}</p>
                <p>
                    @if (Auth::user()->membership_id >= $book->membership_id)
                        <a href="{{ route('user.getbook', $book->id) }}">Read</a>
                    @else
                        <a href="{{ route('pricing') }}">Upgrade</a>
                    @endif

                </p>
            </div>
            @if (!$isFav)
                <form action="{{ route('user.favorite', $book->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-white col-start-3 col-span-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        Add to Favorites
                    </button>
                </form>
            @else
                {{-- remove --}}
                <form action="{{ route('user.favorite.remove', $book->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-white col-start-3 col-span-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 text-white-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                            <path
                                d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                        </svg>
                        Remove from Favorites
                    </button>
                </form>
            @endif

        </div>

    </div>
    </div>

</x-app-layout>
