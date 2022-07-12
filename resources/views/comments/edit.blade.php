<x-app-layout>
    <div class="font-semibold text-4xl text-gray-800 leading-tight text-center mb-12">
        Edit a Discussion
    </div>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-6 bg-gray-100">
    <div class="w-full sm:max-w-2xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
<form method="POST" action="{{ route('comments.update', $comment) }}">
    @csrf
    @method('PUT')
    <div class="mb-6">
        <x-label for="comment" :value="__('Comment')" />
        <textarea id="comment" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="comment" required autofocus>{{$comment->comment}}</textarea>
    </div>
    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Update') }}
        </x-button>
  </form>
    </div>
    </div>
</x-app-layout>
