<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="">
                            <h2 class="text-lg font-semibold capitalize">{{$category->category_name}}</h2>
                            <p class="semibold">items in this category</p>
                        </div>
                        <div class="flex justify-start mt-2 md:mt-0 md:justify-end gap-2">
                            <div class="">
                                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new')"
                                    type="button" class="">Change</x-primary-button>
                            </div>


                            <form action="{{route('category.delete', $category->uuid)}}" method="post">
                                @csrf
                                @method('delete')
                                <x-danger-button onclick="return confirm('Are you sure?')" type="submit">Delete</x-danger-button>
                            </form>

                        </div>
                    </div>

                    <!-- alert -->
                     @if (session('message'))

                    <div x-data="{ show: true }" x-show="show"
                        class="my-6 flex items-center justify-between bg-blue-100 border border-blue-300 text-blue-700 px-6 py-4 rounded-lg">

                        <span class="font-semibold capitalize">
                            {{ session('message') }}
                        </span>

                        <button @click="show = false">
                            ✕
                        </button>

                    </div>
                        
                    @endif

                    <!-- area table -->

                    <div class="bg-white dark:bg-slate-900 rounded-md overflow-hidden mt-8">
                        <table class="w-full">
                            <thead class="bg-blue-50 dark:bg-blue-700">
                                <tr class="uppercase font-semibold text-md">
                                    <th class="px-8 py-4 text-start">Item Name</th>
                                    <th class="px-8 py-4 text-start">Brand</th>
                                    <th class="px-8 py-4 text-start">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                <tr class="border-b border-slate-500">
                                    <td class="px-8 py-4">{{ $item->item_name }}</td>
                                    <td class="px-8 py-4">{{$item->brand}} items</td>
                                    <td class="px-8 py-4">
                                        <a href="" class="">detail</a>
                                    </td>
                                </tr>
                                @empty
                                <tr class="border-b border-slate-500">
                                    <td colspan="3" class="px-8 py-4 text-center">Nothing items</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="create-new" :show="false" focusable>
        <div class="p-8">
            <h2 class="text-2xl text-slate-700 dark:text-slate-200">Change Category</h2>

            <form action="{{route('category.update', $category->uuid)}}" method="post">
                @csrf
                @method('put')

                <div class="mt-4">
                    <x-input-label for="nama_kategori" value="Category Name"></x-input-label>
                    <x-text-input type="text" name="nama_kategori" id="nama_kategori" required class="mt-2 block w-full"
                        :value="old('nama_kategori', $category->category_name)"></x-text-input>
                    <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2"></x-input-error>
                </div>
                <div class="mt-4">
                    <div class="flex justify-end gap-2">
                        <x-danger-button type="button" x-on:click="$dispatch('close')">close</x-danger-button>
                        <x-primary-button type="submit" class="">save</x-primary-button>
                    </div>
                </div>
            </form>

        </div>
    </x-modal>
</x-app-layout>
