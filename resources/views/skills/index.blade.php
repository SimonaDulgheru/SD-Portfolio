@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skills') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('skills.create') }}" 
                   class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">
                   New Skill
                </a>
            </div>
            @if (session('status'))
                <div id="triggerElement" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                        {{ session('status') }}
                    </div>
                    <button type="button" id="targetElement" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#triggerElement" aria-label="Close">
                      <span class="sr-only">Close</span>
                      <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>      
            @endif

            <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Name
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Image
                            </th>
                            <th scope="col" class="flex justify-end py-2 px-6 mr-6">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($skills as $skill)
                            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                <th scope="row" 
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $skill->name }}
                                </th>
                                <td class="py-4 px-6">
                                    <img src="{{ asset('storage/'. $skill->image) }}" class="w-12 h-12" /> 
                                </td>
                                <td class="flex justify-end items-center py-6">
                                    <a href="{{ route('skills.edit', $skill->id) }}" 
                                       class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">
                                       Edit
                                    </a>
                                     <form method="POST" action="{{ route('skills.destroy', $skill->id) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('skills.destroy', $skill->id) }}" 
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline mr-6">
                                            Delete
                                         </a>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-2">
                                    <h2>No skills</h2>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="module">

    $('#targetElement').click(function(e) {

        $('#triggerElement').hide('slow');
    })

</script>