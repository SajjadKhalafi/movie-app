<section class="container mx-auto p-6 font-mono">
    <div class="w-full flex mb-4 p-2 justify-end">
        <x-jet-button>
            Create Serie
        </x-jet-button>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Rating</th>
                    <th class="px-4 py-3">Public</th>
                    <th class="px-4 py-3">Manage</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                <tr class="text-gray-700">
                    <td class="px-4 py-3 border">
                        Title Here
                    </td>
                    <td class="px-4 py-3 text-ms font-semibold border">Date Here</td>
                    <td class="px-4 py-3 text-xs border">
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> Rating Here </span>
                    </td>
                    <td class="px-4 py-3 text-sm border">Public Here</td>
                    <td class="px-4 py-3 text-sm border">Edit/Delete</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>
