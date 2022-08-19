{{-- resources/views/posts/show.blade.php --}}
@extends('layouts.main')

@section('content')
    <article class="mt-6 mx-8">
        <h1 class="text-3xl mb-1">
            {{ $post->title }}
        </h1>

        <p>
            By {{ $post->user->name }}
        </p>

        <div class="mb-4 justify-center items-center">
{{--            <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">--}}
{{--                <svg class="w-6 h-6 inline mr-1" viewBox="0 0 20 20">--}}
{{--                    <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>--}}
{{--                </svg>--}}
{{--                {{ $post->view_count }} views--}}
{{--            </p>--}}

{{--            <label class="switch">--}}
{{--                <input type="checkbox">--}}
{{--                <span class="slider round"></span>--}}
{{--            </label>--}}
            <p class="bg-green-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                <span class="material-symbols-outlined">voting_chip</span>
                &nbsp;{{ $post->like_count }}
            </p>

            <p class="mt-2 bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                @if($post->status === "Waiting")
                    <span style="color: gray" class="material-symbols-outlined">radio_button_checked</span>
                @elseif($post->status === "Received")
                    <span style="color: black" class="material-symbols-outlined">radio_button_checked</span>
                @elseif($post->status === "Progress")
                    <span style="color: #f6bf00" class="material-symbols-outlined">radio_button_checked</span>
                @elseif($post->status === "Completed")
                    <span style="color: #5fdc3b" class="material-symbols-outlined">radio_button_checked</span>
                @else
                    <span style="color: red" class="material-symbols-outlined">radio_button_checked</span>
                @endif
                &nbsp;สถานะ: {{ $post->statusTranslator() }}
            </p>

            <form action="{{ route('posts.status.update', ['post' => $post->id]) }}" method="post">
                @csrf
{{--                @method('PUT')--}}
                <div class="mt-2 bg-gray-100 p-2 rounded">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select an option</label>
                    <select name="status" id="status" class="w-9/12 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
{{--                        <option value="Default" selected>เลือกสถานะ</option>--}}
                        <option value="{{ $post->status }}" selected>{{ $post->status }}</option>
                        @foreach(\array_diff(array("Waiting", "Received", "Progress", "Completed", "Return"), array( $post->status ) ) as $status)
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
{{--                        <option value="Waiting" selected>รอรับเรื่อง</option>--}}
{{--                        <option value="Received">รับเรื่องแล้ว</option>--}}
{{--                        <option value="Progress">กำลังดำเนินการ</option>--}}
{{--                        <option value="Completed">ดำเนินการเสร็จสิ้น</option>--}}
{{--                        <option value="Return">ถูกตีกลับ</option>--}}
                    </select>
{{--                    <button type="button" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Cyan to Blue</button>--}}
                    <button class="app-button" type="submit">แก้ไขสถานะ</button>
                </div>
{{--                <p class="mt-4 bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">--}}
{{--                    <span style="color: green" class="material-symbols-outlined md-18">adjust</span>--}}
{{--                    &nbsp;status: {{ $post->status }}--}}
{{--                </p>--}}
            </form>
        </div>

        <div class="mb-4">
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', ['tag' => $tag->name]) }}">
                    <p class="bg-blue-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline" viewBox="0 0 16 16">
                            <path d="M8.39 12.648a1.32 1.32 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1.06 1.06 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.512.512 0 0 0-.523-.516.539.539 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532 0 .312.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531 0 .313.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242l-.515 2.492zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z"/>
                        </svg>
                        {{ $tag->name }}
                    </p>
                </a>
            @endforeach
        </div>

        <p class="text-gray-900 font-normal p-2 mb-8">
            {{ $post->description }}
        </p>
    </article>

    <section class="mt-8 mx-16">
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-b border-gray-300"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-white px-4 text-sm text-gray-500">ความคิดเห็น</span>
            </div>
        </div>

{{--        <h2 class="text-2xl mb-2">Comments</h2>--}}

        <form class="mb-4" action="{{ route('posts.comments.store', ['post' => $post->id]) }}" method="post">
            @csrf
            <label for="chat" class="sr-only">Your message</label>
            <div class="flex items-center py-2 px-3 bg-gray-200 rounded-lg dark:bg-gray-700">
                <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Upload image</span>
                </button>
                <button type="checkbox" class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
{{--                    <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z" clip-rule="evenodd"></path></svg>--}}
                    <span class="material-symbols-outlined">voting_chip</span>
                </button>
                <textarea name="message" id="chat" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="คุณคิดอะไรอยู่..."></textarea>
                <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                    <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    <span class="sr-only">Send message</span>
                </button>
            </div>
        </form>

        @if ($post->comments->isNotEmpty())

            <div class="flex flex-wrap space-y-2">
            @foreach($post->comments->sortByDesc('created_at') as $comment)
                <div class="block p-6 w-full bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 ">
                    <p class="bg-orange-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                        {{ $comment->created_at->diffForHumans() }}
                        <p class="inline-flex text-gray-400 text-sm">ความคิดเห็นโดย {{ $comment->user->name }}</p>
                    </p>
                    <div class="text-xl pl-4">
                        {{ $comment->message }}
                    </div>
                </div>
            @endforeach
            </div>
        @else
            <div class="pl-8">
                คุณเป็นคนแรกที่นี่
            </div>
        @endif
    </section>

    @can('update', $post)
        <section class="mt-8 mx-8">
            <div class="relative py-4">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-b border-gray-300"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-sm text-gray-500">Action</span>
                </div>
            </div>

            <div>
                <a class="app-button" href="{{ route('posts.edit', ['post' => $post->id]) }}">
                    Edit this post
                </a>
            </div>
        </section>
    @endcan

@endsection
