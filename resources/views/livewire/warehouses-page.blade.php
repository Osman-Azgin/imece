<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage warehouses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="p-4 lg:p-6 bg-white border-b border-gray-200 grid grid-cols-2">
                    <h1 class="col-span-1">{{ __('Your organization\'s warehouses') }}</h1>
                    <div class="col-span-1 text-right">
                        <x-button wire:click="newWarehouse"> {{ __('New Warehouse') }} </x-button>
                    </div>
                </div>
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div class="min-h-full col-span-1">

                        @if (session()->has('success'))
                            <div class="w-full flex items-center justify-center">
                                <div
                                    class="w-full bg-green-600 p-5 rounded-lg drop-shadow-2xl grid grid-cols-5 gap-2 mb-2">
                                    <div class="col-span-4 flex items-center pl-3">
                                        <span class="error text-white">{{ session('success') }}</span>
                                    </div>
                                    <div class="col-span-1 flex items-center justify-end pr-3 text-right">
                                        <button class="p-2 rounded-full hover:bg-gray-100" wire:click="">
                                            <svg style="width: 26px;height:26px;color: white;" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                 class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(count($warehouses)==0)
                            <h1 class="font-medium text-center">{{ __('No warehouses here') }}</h1>
                        @endif

                            @foreach($warehouses as $warehouse)
                                <div class="w-full flex items-center justify-center">
                                    <div class="md:w-3/4 w-full bg-white p-3 md:p-6 rounded-lg drop-shadow-2xl grid grid-cols-5 gap-2 mb-2">
                                        <div class="col-span-4 flex items-center pl-3">
                                            <svg style="width: 30px;height:30px;color:purple;margin-right: 15px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                            </svg>

                                            {{ $warehouse->name }}
                                        </div>
                                        <div class="col-span-1 flex items-center justify-end pr-3">
                                            <button class="p-2 rounded-full hover:bg-gray-100" wire:click="edit({{ $warehouse->id }})">
                                                <svg style="width: 26px;height:26px;color: purple;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal wire:model="delete_modal">
        <x-slot name="title">
            {{ __("Delete Warehouse") }}
        </x-slot>

        <x-slot name="content">
            {{ __("Are you sure to delete this waregouse?") }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('delete_modal')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="removeTeam" wire:loading.attr="disabled">
                {{ __("Delete Warehouse") }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
