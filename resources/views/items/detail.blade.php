<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Items
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div>
                            <h2 class="text-lg font-semibold capitalize">{{ $item->item_name }}</h2>
                            <p class="semibold">{{$item->brand}}</p>
                        </div>
                        <div class="flex justify-start mt-2 md:mt-0 md:justify-end gap-2">
                            <div>
                                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new')"
                                    type="button">Change</x-primary-button>
                            </div>

                            <form action="{{ route('items.destroy', $item->uuid) }}" method="post">
                                @csrf
                                @method('delete')
                                <x-danger-button onclick="return confirm('Are you sure?')" type="submit">
                                    Delete
                                </x-danger-button>
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

                    <!-- area detail -->
                    <div class="bg-white dark:bg-slate-900 mt-6 rounded-lg overflow-hidden border border-slate-100 dark:border-slate-800">
                        <div class="p-10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div>
                                    <img src="{{ asset('storage/images/items/' . $item->image) }}"
                                        class="rounded-3xl w-full object-cover" alt="Barang">
                                </div>

                                <div>
                                    <h2 class="text-3xl font-black text-slate-800 dark:text-white">
                                        {{ $item->item_name }}
                                    </h2>
                                    <p class="text-slate-400 mt-2">
                                        {{ $item->desc }}
                                    </p>

                                    <div class="mt-8 space-y-5">
                                        <div>
                                            <p class="text-sm text-slate-400">Category</p>
                                            <h3 class="font-black text-slate-700 dark:text-white">
                                                {{ $item->category->category_name }}
                                            </h3>
                                        </div>

                                        <div>
                                            <p class="text-sm text-slate-400">Brand</p>
                                            <h3 class="font-black text-slate-700 dark:text-white">
                                                {{ $item->brand }}
                                            </h3>
                                        </div>

                                        <div>
                                            <p class="text-sm text-slate-400">Status</p>
                                            <h3 class="font-black {{ $item->status === 'good' ? 'text-emerald-500' : ($item->status === 'broke' ? 'text-rose-500' : 'text-yellow-500') }}">
                                                {{ $item->status === 'good' ? 'good condition' : ($item->status === 'broke' ? 'item broke' : 'under maintenance') }}
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->
            <x-modal name="create-new" :show="false" focusable>
                <div class="p-8">
                    <h2 class="text-2xl text-slate-700 dark:text-slate-200">Change Category</h2>

                    <form action="{{ route('items.update', $item->uuid) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div class="mt-4">
                                <x-input-label for="nama_barang" value="Item Name"></x-input-label>
                                <x-text-input type="text" name="nama_barang" id="nama_barang" required
                                    class="mt-2 block w-full" :value="old('nama_barang', $item->item_name)"></x-text-input>
                                <x-input-error :messages="$errors->get('nama_barang')" class="mt-2"></x-input-error>
                            </div>
                            <div class="mt-4">
                                <x-input-label for="kategori_barang" value="Category"></x-input-label>
                                <x-select class="mt-2 block w-full" name="kategori_barang" id="kategori_barang" required>
                                    <option value="" disabled>Choose Category</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}" @selected(old('kategori_barang', $item->category_id) == $cat->id)>
                                            {{ $cat->category_name }}
                                        </option>
                                    @endforeach
                                </x-select>
                                <x-input-error :messages="$errors->get('kategori_barang')" class="mt-2"></x-input-error>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                            <div class="mt-4">
                                <x-input-label for="merk" value="Brand"></x-input-label>
                                <x-text-input type="text" name="merk" id="merk" required class="mt-2 block w-full"
                                    :value="old('merk', $item->brand)"></x-text-input>
                                <x-input-error :messages="$errors->get('merk')" class="mt-2"></x-input-error>
                            </div>
                            <div class="mt-4">
                                @php
                                    $pilihan = [
                                        'good' => 'good',
                                        'broke' => 'broke',
                                        'maintenance' => 'maintenance',
                                    ];
                                @endphp
                                <x-input-label for="" value="Status Items"></x-input-label>

                                @foreach ($pilihan as $kondisi => $label)
                                    <div class="flex justify-between">
                                        <label for="{{ $label }}" class="mt-2">
                                            <input type="radio" name="status" id="{{ $label }}" value="{{ $kondisi }}"
                                                @checked(old('status', $item->status) == $kondisi)>
                                            <span class="ms-2 text-sm text-slate-800 dark:text-slate-200">{{ $label }}</span>
                                        </label>
                                    </div>
                                @endforeach
                                <x-input-error :messages="$errors->get('status')" class="mt-2"></x-input-error>
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="gambar_barang" value="Image Item"></x-input-label>
                            <x-text-input type="file" name="gambar_barang" id="gambar_barang"
                                class="mt-2 py-6 px-2 border block w-full" accept="image/*"
                                :value="old('gambar_barang')"></x-text-input>
                            <x-input-error :messages="$errors->get('gambar_barang')" class="mt-2"></x-input-error>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="deskripsi" value="Description"></x-input-label>
                            <textarea name="deskripsi" id="deskripsi"
                                class="mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('deskripsi', $item->desc) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2"></x-input-error>
                        </div>

                        <div class="mt-4">
                            <div class="flex justify-end gap-2">
                                <x-danger-button type="button" x-on:click="$dispatch('close')">close</x-danger-button>
                                <x-primary-button type="submit">save</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </x-modal>

        </div>
    </div>
</x-app-layout>