<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-2xl p-6 bg-white border-b border-gray-200 text-center">
                    <p class="text-green-500">Your token has been succesfully activated!</p>
                    <p>Go ahead and <a class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600" href="{{ route('login') }}">login</a>!</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
