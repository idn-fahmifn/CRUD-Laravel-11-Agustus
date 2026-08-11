<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                   <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="">
                        <h2 class="text-lg font-semibold">All Categories</h2>
                    </div>
                    <div class="flex justify-start mt-2 md:mt-0 md:justify-end">
                        <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-new')" 
                        type="button" class="">Add</x-primary-button>
                    </div>
                   </div>

                   <!-- area table -->

                   <div class="bg-white dark:bg-slate-900 rounded-md overflow-hidden mt-8">
                    <table class="w-full">
                        <thead class="bg-blue-50 dark:bg-blue-700">
                            <tr class="uppercase font-semibold text-md">
                                <th class="px-8 py-4 text-start" >Category Name</th>
                                <th class="px-8 py-4 text-start" >Total Items</th>
                                <th class="px-8 py-4 text-start" >#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-slate-500">
                                <td class="px-8 py-4">test</td>
                                <td class="px-8 py-4">test</td>
                                <td class="px-8 py-4">test</td>
                            </tr>
                            <tr class="border-b border-slate-500">
                                <td class="px-8 py-4">test</td>
                                <td class="px-8 py-4">test</td>
                                <td class="px-8 py-4">test</td>
                            </tr>
                            <tr class="border-b border-slate-500">
                                <td class="px-8 py-4">test</td>
                                <td class="px-8 py-4">test</td>
                                <td class="px-8 py-4">test</td>
                            </tr>
                            <tr class="border-b border-slate-500">
                                <td class="px-8 py-4">test</td>
                                <td class="px-8 py-4">test</td>
                                <td class="px-8 py-4">test</td>
                            </tr>
                        </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-new" :show="false" focusable>
        <div class="p-8"></div>
    </x-modal>

</x-app-layout>
