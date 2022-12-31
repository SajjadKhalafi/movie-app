<section class="container mx-auto p-6 font-mono">
    @if(\Illuminate\Support\Facades\Session::has('flash.banner'))
        <x-m-flash-banner />
    @endif
    <div class="w-full flex mb-4 p-2 justify-end">
        <x-jet-button wire:click="showCreateModal">
            Create Tag
        </x-jet-button>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Title</th>
                    <th class="px-4 py-3">Slug</th>
                    <th class="px-4 py-3">Manage</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                @forelse($tags as $tag)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border">
                            {{ $tag->tag_name }}
                        </td>
                        <td class="px-4 py-3 border">
                            {{ $tag->slug }}
                        </td>
                        <td class="px-4 py-3 text-sm border">
                            <x-m-button wire:click="showEditModal({{ $tag->id }})"
                                          class="bg-blue-500 hover:bg-blue-700 font-bold">Edit
                            </x-m-button>
                            <x-m-button wire:click="deleteTag({{ $tag->id }})"
                                          class="bg-red-500 hover:bg-red-700 font-bold">Delete
                            </x-m-button>
                        </td>
                    </tr>
                @empty
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 border" colspan="3">
                            Empty
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <x-jet-dialog-modal wire:model="showTagModal">
        <x-slot name="title">
            @if($tagId)
                Update Tag
            @else
                Create Tag
            @endif
        </x-slot>
        <x-slot name="content">
            <div class="mt-10 sm:mt-0">
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <form>
                        <div class="overflow-hidden shadow sm:rounded-md">
                            <div class="bg-white px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="tagName" class="block text-sm font-medium text-gray-700">Tag
                                            name</label>
                                        <input type="text" wire:model="tagName" autocomplete="given-name"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            @if($tagId)
                <x-m-button wire:click="updateTag">
                    Update
                </x-m-button>
            @else
                <x-m-button wire:click="createTag">
                    Create
                </x-m-button>
            @endif
            <x-jet-button wire:click="closeTagModal">
                Close
            </x-jet-button>

        </x-slot>
    </x-jet-dialog-modal>
</section>
