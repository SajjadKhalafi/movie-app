<section class="container mx-auto p-6 font-mono">
    @if(\Illuminate\Support\Facades\Session::has('flash.banner'))
        <x-m-flash-banner/>
    @endif
    <div class="w-full flex mb-4 p-2 justify-end">
        <form class="flex shadow bg-white rounded-md m-2 p-2">
            <div class="p-1 flex items-center">
                <label for="castTMDBid" class="block text-sm font-medium text-gray-700 md:mr-4">Cast Tmdb Id</label>
                <div class="relative rounded-md shadow-sm">
                    <input wire:model="castTMDBid" id="tmdb_id_g" name="tmdb_id_g"
                           class="px-3 py-2 border border-gray-300 rounded" placeholder="Cast TMDB ID"/>
                </div>
            </div>
            <div class="p-1">
                <button wire:click="generateCast" type="button"
                        class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 transition duration-150 ease-in-out disabled:opacity-50">
                    <span>Generate</span>
                </button>
            </div>
        </form>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Poster</th>
                    <th class="px-4 py-3">Manage</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @forelse($casts as $cast)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">
                            {{ $cast->name }}
                        </td>
                        <td class="px-4 py-3 text-ms font-semibold border">{{ $cast->slug }}</td>
                        <td class="px-4 py-3 text-sm border">{{ $cast->poster_path }}</td>
                        <td class="px-4 py-3 text-sm border">
                            <x-m-button wire:click="showEditModal({{ $cast->id }})"
                                        class="bg-blue-500 hover:bg-blue-700 font-bold">Edit
                            </x-m-button>
                            <x-m-button wire:click="deleteCast({{ $cast->id }})"
                                        class="bg-red-500 hover:bg-red-700 font-bold">Delete
                            </x-m-button>
                        </td>
                    </tr>
                @empty
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border" colspan="4">
                            Empty
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div>
                {{ $casts->links() }}
            </div>
        </div>
    </div>
    <x-jet-dialog-modal wire:model="showCastModal">
        <x-slot name="title">
            Update Cast
        </x-slot>
        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form>
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="tagName" class="block text-sm font-medium text-gray-700">Cast
                                            name</label>
                                        <input type="text" wire:model="castName" autocomplete="given-name"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('castName') {{ $message }} @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="tagName" class="block text-sm font-medium text-gray-700">Cast
                                            PosterPath</label>
                                        <input type="text" wire:model="castPosterPath" autocomplete="given-name"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('castPosterPath') {{ $message }} @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-m-button wire:click="updateCast">
                Update
            </x-m-button>
            <x-jet-button wire:click="closeCastModal">
                Close
            </x-jet-button>

        </x-slot>
    </x-jet-dialog-modal>
</section>
