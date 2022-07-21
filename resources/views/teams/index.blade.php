<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-center text-5xl mb-6">Teams</h1>
            @admin
                <a href="{{ route('teams.create') }}" role='button'
                    class='inline-flex items-end px-4 py-2 m-4 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150'>
                    Add Team
                </a>
            @endadmin
            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Home Team
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Guest Team
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $team)
                        <tr class="bg-white border-b">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                {{$team->name}}
                            </th>
                            <td class="py-4 px-6">
                                {{$team->foundation_year}}
                            </td>
                            <td class="py-4 px-6">
                                <form action="{{ route('teams.edit', $team->id) }}" method="GET">
                                    @csrf
                                    <button class="inline text-blue-700" type="submit">Edit</button>
                                </form>
                                <form action="{{ route('teams.destroy', $team->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="inline text-blue-700" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
