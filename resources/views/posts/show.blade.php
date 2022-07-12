<x-app-layout>
    @if (Session::has('message'))

        @if (Session::get('status') == 'success')
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800 text-center"
                role="alert">
                {{ Session::get('message') }}
            </div>
        @else
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800 text-center"
                role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
    @endif
    <div
        class="bg-white w-full max-w-full flex flex-col overflow-hidden shadow-sm sm:rounded-lg mb-4 justify-center relative">
        <div class="p-6 bg-white">
            <div class=" w-full lg:max-w-full p-6 md:p-6 lg:p-12">
                <img class="w-full" src="{{ $post['url'] }}" alt="Post Image">
                <div
                    class="bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-center leading-normal">
                    <div class="text-gray-900 font-bold text-2xl mb-2 mt-4">{{ $post['title'] }}</div>
                    <p class="text-gray-700 text-base">{{ $post['description'] }}</p>
                </div>
            </div>
        </div>
        <div class="p-2 md:p-4 lg:p-6 bg-transparent absolute top-0 right-0">
            {{ $post->category->name }} | {{ $post->user->username }}
        </div>
    </div>
    @if (Auth::check())
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            <div class="mb-6">
                <x-label for="comment" :value="__('Comment')" />
                <x-textarea id="comment" class="block mt-1 w-full" type="text" name="comment" required autofocus />
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="post_id" value="{{ $post['id'] }}">
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Add a comment') }}
                </x-button>
            </div>
        </form>
    @else
        <div
            class="bg-white  w-full max-w-full overflow-hidden shadow-sm sm:rounded-lg mb-4 justify-between lg:relative">
            <div class="p-4 bg-white">
                <div class=" w-full max-w-full">
                    <div
                        class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 text-center leading-normal">
                        <div class="text-gray-900 font-semibold text-md">You need to be a logged in to post a comment!</div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <p class="text-3xl my-4">Comments:</p>
    @forelse($comments->where('post_id', $post['id']) as $comment)
        <div
            class="bg-white  w-full max-w-full overflow-hidden shadow-sm sm:rounded-lg mb-4 justify-between lg:relative">
            <div class="p-4 bg-white">
                <div class=" w-full max-w-full lg:flex">

                    <div
                        class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-2 lg:p-4 flex flex-col justify-center leading-normal">
                        <div class="text-gray-900 font-semibold text-md mb-2">{{ $comment->users->username }} says:
                        </div>
                        <p class="text-gray-700 font-semibold text-lg mb-2">{{ $comment['comment'] }}</p>
                        @if (Auth::check())
                            @if (Auth::user()->role_id == 2 || Auth::user()->id == $comment['user_id'])
                                <div class="flex gap-2">
                                    <a href="{{ route('comments.edit', $comment) }}"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="p-2 lg:p-6 bg-white lg:absolute top-0.5 right-0.5">
                {{ $comment['created_at'] }}
            </div>
        </div>
    @empty
        <div class="text-2xl text-center mt-6 text-neutral-500">Nothing here yet! Start a topic!</div>
    @endforelse
</x-app-layout>
