@extends('admin.index')
@section('content')
    <form class="w-1/2 max-w:sm
    mx-auto"
        action="{{ !$view ? route('admin.books.store') : route('admin.books.update', ["$book->id"]) }}" method="POST">
        @if ($view)
            @method('PUT')
        @endif
        <div
            class="
         block max-w p-6 bg-white border border-gray-200 rounded-lg shadow  dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl view-title font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $view ? "Preview Book: $book->id" : 'Add a New Book' }}</h5>

            @csrf
            <div class="relative z-0 w-full mb-5 group">
                <label for="genre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title </label>
                <input type="text" name="title" id="title" {{ $view ? "value=$book->title disabled" : '' }}
                    class="block view-input py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />


            </div>
            <label for="genre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre </label>
            <div class="grid md:grid-cols-2 md:gap-6">

                <select id="genre" name="genre_id" {{ $view ? 'disabled' : '' }}
                    class="select-genre view-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                    @foreach ($genres as $genre)
                        <option value="{{ $gen_counter++ }}"
                            {{ $view ? ($genre->name == $book->genre->name ? 'selected' : '') : '' }}>{{ $genre->name }}
                        </option>
                    @endforeach

                </select>

                <a data-modal-target="add-genre" data-modal-toggle="add-genre"
                    style="display: {{ $view ? 'none' : 'block' }}"
                    class="flex new-genre items-center p-3 text-sm font-medium text-blue-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-blue-500 hover:underline">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 18">
                        <path
                            d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z" />
                    </svg>
                    Add new genre
                </a>

                <div class="relative z-0 w-full mb-5 group">
                    <label for="author" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">Author
                    </label>
                    <input type="text" name="author" id="author" {{ $view ? "value=$book->author disabled" : '' }}
                        class="block py-2.5 view-input px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />

                </div>


                <div class="relative z-0 w-full mb-5 group">
                    <label for="author"
                        class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">Publisher
                    </label>
                    <input type="text" name="publisher" id="publisher"
                        {{ $view ? "value=$book->publisher disabled" : '' }}
                        class="block py-2.5 view-input px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />

                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6 mt-6">

                <div class="relative z-0 w-full mb-5 group">
                    <label for="cover" class="block  mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">Cover
                    </label>
                    <input type="file" name="cover" id="cover" style="display:{{ $view ? 'none' : '' }}"
                        class="block update-button py-2.5 px-0 view-input w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " />
                    @if ($view)
                        <img src={{ $book->cover }}>
                    @endif

                </div>

                <div class="relative z-0 w-full mb-5 group">
                    <label for="file" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">File
                    </label>
                    <input type="file" name="file" id="file" style="display:{{ $view ? 'none' : '' }}"
                        class="block update-button py-2.5 px-0 view-input w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " />
                    @if ($view)
                        <a href={{ $book->path }}>View</a>
                    @endif

                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6 mt-6">

                <div class="relative z-0 w-full mb-5 group">

                    <label for="membership"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Membership</label>

                    <select id="membership" name="membership_id" {{ $view ? "value=$book->membership disabled" : '' }}
                        class="bg-gray-50 border view-input border-gray-300  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($memberships as $membership)
                            <option value="{{ $mem_counter++ }}"
                                {{ $view ? ($membership->title == $book->membership->title ? 'selected' : '') : '' }}>
                                {{ $membership->title }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="relative z-0 w-full mb-5 group">


                    <label for="language"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Language</label>

                    <select id="language" name="language" {{ $view ? 'disabled' : '' }}
                        class="bg-gray-50 view-input border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="ku">Kurdish</option>
                        <option value="en">English</option>
                        <option value="ar">Arabic</option>


                    </select>
                </div>
            </div>



            <div class="relative z-0 w-full mb-5 group">
                <label for="ISBN" class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">ISBN
                </label>
                <input type="text" name="ISBN" id="isbn" {{ $view ? "value=$book->ISBN disabled" : '' }}
                    class="block view-input py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />

            </div>


            <div class="relative z-0 w-full mb-5 group">
                <label for="date_of_publication"
                    class="block mb-2 mt-3 text-sm font-medium text-gray-900 dark:text-white">Date of Publication

                    <input type="date" name="date_of_publication" id="date_of_publication"
                        {{ $view ? "value=$book->date_of_publication disabled" : '' }}
                        class="block view-input py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required />

            </div>


            <button type="submit" style="display: {{ $view ? 'none' : 'block' }}"
                class="text-white update-button bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
    <!-- Add Genre Modal -->
    <div id="add-genre" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full h-auto max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="add-genre">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                        fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                        Add Genre</h3>
                    <form action="{{ route('admin.genre.create') }}" method="POST">
                        @csrf
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="name" id="name"
                                class="block py-2.5 px-0 w-full text-sm genrename text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required />
                            <label for="name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Genre</label>
                        </div>
                        <button data-modal-toggle="add-genre" type="button" id="add-genre-button"
                            class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Add
                            Genre</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    @if ($view)
        <div data-dial-init class="fixed top-6 right-24 group">

            <button type="button" data-dial-toggle="speed-dial-menu-dropdown-alternative"
                aria-controls="speed-dial-menu-dropdown-alternative" aria-expanded="false"
                class="flex items-center speed-dial-button justify-center ml-auto text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="m13.835 7.578-.005.007-7.137 7.137 2.139 2.138 7.143-7.142-2.14-2.14Zm-10.696 3.59 2.139 2.14 7.138-7.137.007-.005-2.141-2.141-7.143 7.143Zm1.433 4.261L2 12.852.051 18.684a1 1 0 0 0 1.265 1.264L7.147 18l-2.575-2.571Zm14.249-14.25a4.03 4.03 0 0 0-5.693 0L11.7 2.611 17.389 8.3l1.432-1.432a4.029 4.029 0 0 0 0-5.689Z" />
                </svg>
                <span class="sr-only">Open actions menu</span>
            </button>
        </div>
    @endif
    </div>
@endsection
