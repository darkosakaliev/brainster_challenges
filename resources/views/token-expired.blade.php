<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-2xl p-6 bg-white border-b border-gray-200 text-center">
                    <p class="text-red-500">Your token has expired!</p>
                    <p>Create a new token and try again
                        <a
                        class="underline text-blue-600 hover:text-blue-800 visited:text-purple-600"
                        href="{{ route('resendToken', [$user->email, $user->activation_token] ) }}">here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
