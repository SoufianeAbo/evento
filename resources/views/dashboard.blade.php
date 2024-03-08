<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @hasanyrole('organisator')
            {{ __('Events') }}
            @else
            {{ __('Dashboard') }}
            @endhasanyrole
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @role('admin')
                    <div class="bg-gray-50">
                        @if (session('message') == 'banned')
                        <div class="flex items-center p-4 mb-8 text-sm text-green-800 border border-green-300 rounded-lg bg-green-500" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Success!</span>
                            </div>
                        </div>
                        @endif
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="max-w-4xl mx-auto text-center">
                                <h2 class="text-3xl font-extrabold text-red-900 sm:text-4xl">
                                    <i class="fa-solid fa-user-tie mr-4"></i>Administrator Dashboard
                                </h2>
                                <p class="mt-3 text-xl text-gray-500 sm:mt-4">
                                    Check all the stats of the Evento company.
                                </p>
                            </div>
                        </div>
                        <div class="mt-10 pb-1">
                            <div class="relative">
                                <div class="absolute inset-0 h-1/2 bg-gray-50"></div>
                                <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                                    <div class="max-w-4xl mx-auto">
                                        <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                                            <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                                    Users
                                                </dt>
                                                <dd class="order-1 text-5xl font-extrabold text-gray-700"><i class="fa-solid fa-users mr-2"></i> {{ $users }}</dd>
                                            </div>
                                            <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                                    Organizators
                                                </dt>
                                                <dd class="order-1 text-5xl font-extrabold text-gray-700"><i class="fa-solid fa-users-gear mr-2"></i>{{ $organizators }}</dd>
                                            </div>
                                            <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                                                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                                                    Events
                                                </dt>
                                                <dd class="order-1 text-5xl font-extrabold text-gray-700">30+</dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersData as $user)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-10 h-10 rounded-full" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Jese image">
                                        <div class="ps-3">
                                            <div class="text-base font-semibold text-black">{{ $user->name }}</div>
                                            <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        @if ($user->hasRole('organisator'))
                                        Organizator
                                        @elseif ($user->hasRole('admin'))
                                        Admin
                                        @else
                                        User
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if ($user->hasPermissionTo('restrict access'))
                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 me-2"></div> Banned
                                            @else
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Active
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('ban.user') }}" method="POST">
                                            @csrf
                                            <input name="id" type="text" value="{{ $user->id }}" class="hidden">
                                            @if ($user->hasPermissionTo('restrict access'))
                                            <button type="submit" class="font-medium text-green-600 hover:underline"><i class="fa-solid fa-hammer mr-2"></i>Unban user</button>
                                            @else
                                            @if ($user->hasRole('admin'))
                                            <p class="font-medium text-red-600">Cannot ban an admin.</p>
                                            @else
                                            <button type="submit" class="font-medium text-red-600 hover:underline"><i class="fa-solid fa-hammer mr-2"></i>Ban user</button>
                                            @endif
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @elserole('organisator')
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($events as $event)
                        <div class="lg:flex shadow rounded-lg border  border-gray-400">
                            <div class="bg-blue-600 rounded-lg lg:w-2/12 py-4 px-2 block h-full shadow-inner">
                                <div class="text-center tracking-wide">
                                    <div class="text-white font-bold text-4xl ">{{ Carbon\Carbon::parse($event->date)->format('d') }}</div>
                                    <div class="text-white font-normal text-2xl">{{ Carbon\Carbon::parse($event->date)->format('M') }}</div>
                                    <div class="text-white font-normal text-2xl">{{ Carbon\Carbon::parse($event->date)->format('Y') }}</div>
                                </div>
                            </div>
                            <div class="w-full  lg:w-11/12 xl:w-full px-1 bg-white py-5 lg:px-2 lg:py-2 tracking-wide">
                                <div class="flex flex-row lg:justify-start justify-center">
                                    <div class="text-gray-700 font-medium text-sm text-center lg:text-left px-2">
                                        <i class="fa-solid fa-couch"></i> {{ $event->spots }}
                                    </div>
                                    <div class="text-gray-700 font-medium text-sm text-center lg:text-left px-2">
                                        <i class="fa-solid fa-user-gear"></i> {{ $event->user->name }}
                                    </div>
                                    <div class="text-gray-700 font-medium text-sm text-center lg:text-left px-2">
                                        <i class="fa-solid fa-icons"></i> {{ $event->category->name }}
                                    </div>
                                </div>
                                <div class="font-semibold text-gray-800 text-xl text-center lg:text-left px-2">
                                    {{ $event->title }}
                                </div>

                                <div class="text-black font-medium text-md text-center lg:text-left px-2">
                                    {{ $event->description }}
                                </div>

                                <div class = "flex flex-row pt-4 px-2 gap-4">
                                    <a class = "text-blue-600 hover:underline" href="#"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <form action="{{ route('delete.event') }}" method = "POST">
                                        @csrf
                                        <input type="text" class = "hidden" name = "eventId" value = "{{ $event->id }}">
                                        <button type = "submit" class = "text-red-600 hover:underline" href="#"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                            <div class="flex flex-row items-center w-full lg:w-1/3 bg-white lg:justify-end justify-center px-2 py-4 lg:px-0">
                                <span class="tracking-wider text-gray-600 bg-gray-200 px-2 text-sm rounded leading-loose mx-2 font-semibold">
                                    {{ $event->status }}
                                </span>

                            </div>
                        </div>
                        @endforeach
                        <div onclick = "eventCreator.showModal()" class="cursor-pointer text-5xl text-white flex justify-center items-center bg-green-600 w-full rounded py-12">
                            <i class="fa-solid fa-circle-plus"></i>
                        </div>
                    </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>

    <dialog id="eventCreator" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg mb-4">Create new event</h3>
        <form id = "eventForm" method = "POST" action = "{{ route('create.event') }}">
            @csrf
            <x-input-label for="eventsTitle" :value="__('Title')" />
            <x-text-input id="eventsTitle" class="block mt-1 mb-2 w-full" type="text" name="title" :value="old('category')" required autofocus />
            <x-input-error :messages="$errors->get('eventTitle')" class="my-2" />

            <x-input-label for="eventsDesc" :value="__('Description')" />
            <x-text-input id="eventsDesc" class="block mt-1 mb-2 w-full" type="text" name="description" :value="old('category')" required autofocus />
            <x-input-error :messages="$errors->get('eventDesc')" class="my-2" />

            <x-input-label for="eventsDate" :value="__('Date')" />
            <x-text-input id="eventsDate" class="block mt-1 mb-2 w-full" type="date" name="date" :value="old('category')" required autofocus />
            <x-input-error :messages="$errors->get('eventDate')" class="my-2" />

            <x-input-label for="eventsLoca" :value="__('Location')" />
            <x-text-input id="eventsLoca" class="block mt-1 mb-2 w-full" type="text" name="location" :value="old('category')" required autofocus />
            <x-input-error :messages="$errors->get('eventLoca')" class="my-2" />

            <x-input-label for="events" :value="__('Category')" />
            <select class = "border-gray-300 mb-2 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="categoryId">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('event')" class="mt-2" />

            <x-input-label for="eventsNumb" :value="__('Number of places')" />
            <x-text-input id="eventsNumb" class="block mt-1 mb-2 w-full" type="number" name="spots" :value="old('category')" required autofocus />
            <x-input-error :messages="$errors->get('eventNumb')" class="mt-2" />

            <input name = "organizerId" type="text" class = "hidden" value = "{{ $currentUser->id }}">
            <input name = "status" type="text" class = "hidden" value = "Pending">

            <p class = "block font-medium text-sm text-gray-700">Activation</p>
            <ul class="grid w-full gap-6 md:grid-cols-2 mt-4">
            <li>
                <input type="radio" id="activation-auto" name="activation" value="auto" class="hidden peer" checked required />
                <label for="activation-auto" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600">                           
                    <div class="block">
                        <div class="w-full text-lg font-semibold">Automatic</div>
                        <div class="w-full">Users will be automatically accepted</div>
                    </div>
                    <p class = "text-3xl"><i class="fa-solid fa-wand-sparkles"></i></p>
                </label>
            </li>
            <li>
                <input type="radio" id="activation-manual" name="activation" value="manual" class="hidden peer">
                <label for="activation-manual" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600">
                    <div class="block">
                        <div class="w-full text-lg font-semibold">Manual</div>
                        <div class="w-full">Users will have to wait for a manual acceptation</div>
                    </div>
                    <p class = "text-3xl"><i class="fa-solid fa-handshake-angle"></i></p>
                </label>
            </li>
        </ul>
        </form>
        <div class="modal-action">
        <form method="dialog">
            <button type = "submit" form = "eventForm" class = "text-white btn-success btn">Submit</button>
            <button class="btn">Close</button>
        </form>
        </div>
    </div>
    </dialog>
</x-app-layout>