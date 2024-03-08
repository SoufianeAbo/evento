<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Category name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $category->name }}
                                </th>
                                <td class="px-6 py-4">
                                    <div class = "flex flex-col">
                                        <label for = "category-{{ $category->id }}" class = "cursor-pointer text-blue-500 hover:underline"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</label>
                                        <form action="{{ route('delete.category') }}" method = "POST">
                                            @csrf
                                            <input type="text" class = "hidden" name = "id" value = "{{ $category->id }}">
                                            <button class = "text-red-500 hover:underline"><i class="fa-solid fa-trash mr-2"></i>Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            <tr onclick="category.showModal()" class = "cursor-pointer bg-green-500 border-b">
                                <th colspan = "4" scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                <i class="fa-solid fa-icons mr-2"></i> Create new category...
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <dialog id="category" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Create new category</h3>
        <form id = "categoryForm" method = "POST" action = "{{ route('create.category') }}">
            @csrf
            <x-input-label for="categories" :value="__('Category')" />
            <x-text-input id="categories" class="block mt-1 w-full" type="text" name="name" :value="old('category')" required autofocus />
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </form>
        <div class="modal-action">
        <form method="dialog">
            <button type = "submit" form = "categoryForm" class = "btn-success btn">Submit</button>
            <button class="btn">Close</button>
        </form>
        </div>
    </div>
    </dialog>
    @foreach ($categories as $category)
    <input type = "checkbox" id="category-{{ $category->id }}" class="modal-toggle" />
    <div class="modal" role="dialog">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Edit category {{ $category->name }}</h3>
        <form id = "categoryForm{{ $category->id }}" method = "POST" action = "{{ route('edit.category') }}">
            @csrf
            <x-input-label for="categories" :value="__('Category')" />
            <input type="text" class = "hidden" value = "{{ $category->id }}" name = "id" />
            <x-text-input id="categories" class="block mt-1 w-full" type="text" name="name" value="{{ $category->name }}" required autofocus />
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </form>
        <div class="modal-action">
        <form method="dialog">
            <button type = "submit" form = "categoryForm{{ $category->id }}" class = "btn-success btn">Submit</button>
            <label for = "category-{{ $category->id }}" class="btn">Close</label>
        </form>
        </div>
    </div>
    </div>
    @endforeach
</x-app-layout>
