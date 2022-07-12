<x-app-layout>
    <div class="font-semibold text-4xl text-gray-800 leading-tight text-center mb-12">
        Add a Discussion
    </div>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-6 bg-gray-100">
    <div class="w-full sm:max-w-2xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="mb-6">
        <x-label for="title" :value="__('Title')" />
        <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
    </div>
    <div class="mb-6">
        <x-label for="url" :value="__('Image URL')" />
        <x-input id="url" class="block mt-1 w-full" type="url" name="url" :value="old('url')" required autofocus />
    </div>
    <div class="mb-6">
        <x-label for="description" :value="__('Description')" />
        <x-textarea id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" required autofocus />
    </div>
    <div class="mb-6">
        <x-label for="category_id" :value="__('Category')" />
        <select class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="category_id" class="block mt-1 w-full" type="text" name="category_id" :value="old('category_id')" required autofocus>
            @foreach($categories as $category)
            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <div class="flex items-center justify-end mt-4">
        <x-button class="ml-4">
            {{ __('Create') }}
        </x-button>
  </form>
    </div>
    </div>
</x-app-layout>
