@if (Auth::user()->role_id == 2)
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


    <a href="{{ route('posts.create') }}" role="button"
        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
        Add new discussion
    </a>
    @forelse ($posts as $post)
        <div
            class="bg-white w-full max-w-full overflow-hidden shadow-sm sm:rounded-lg mb-4 justify-center lg:justify-between lg:relative">
                <div class="p-6 bg-white">
                    <div class="w-full max-w-full lg:flex">
                        <img class="md:h-48 lg:h-auto lg:w-48 bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
                            src="{{ $post['url'] }}" alt="Post Image">
                        <div
                            class="bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-center leading-normal">
                            <div class="text-gray-900 font-bold text-xl mb-2">{{ $post['title'] }}</div>
                            <p class="text-gray-700 text-base mb-2">{{ $post['description'] }}</p>
                            @if (Auth::check())
                            @if (Auth::user()->role_id == 2 || Auth::user()->id == $post['id'])
                            <div class="flex gap-2">
                                <form action="{{ route('posts.approve', $post) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button><i class="fa-solid fa-check"></i></button>
                                </form>
                                <a href="{{ route('posts.edit', $post) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
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
                {{ $post->category->name }} | {{ $post->user->username }}
            </div>
        </div>

    @empty

    <div class="text-4xl text-center mt-6 text-neutral-500">Nothing here yet! Start a topic!</div>

    @endforelse
</x-app-layout>
@endif
