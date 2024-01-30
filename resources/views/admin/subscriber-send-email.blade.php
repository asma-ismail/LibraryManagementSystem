@extends('admin.index')
@section('content')

    <form class="w-1/2 max-w:sm
    mx-auto" action="{{ route('admin.subscriber_send_email_submit') }}" method="POST">

        <div
            class="
         block max-w p-6 bg-white border border-gray-200 rounded-lg shadow  dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl view-title font-bold tracking-tight text-gray-900 dark:text-white">
                Send Email to Subscribers</h5>

            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="relative z-0 w-full mb-5 group">
                <label for="subject" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject </label>
                <input type="text" name="subject" id="subject"
                    class="block view-input py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />


            </div>
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message </label>
            <div class="grid md:gap-6">
                <textarea name="message" cols="30" rows="10"></textarea>





            </div>
            <button type="submit"
                class="text-white update-button bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </div>
    </form>

@endsection
