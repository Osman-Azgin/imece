<div wire:submit.prevent="save" class=" w-full md:w-3/4 p-6">

    @error('form')
    <div class="w-full flex items-center justify-center">
        <div
            class="w-full bg-red-700 p-5 rounded-lg drop-shadow-2xl grid grid-cols-5 gap-2 mb-2">
            <div class="col-span-4 flex items-center pl-3">
                <span class="error text-white">{{ $message }}</span>
            </div>
            <div class="col-span-1 flex items-center justify-end pr-3 text-right">
                <button class="p-2 rounded-full hover:bg-gray-100" wire:click="removeFormError">
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
    @enderror
    @if (session()->has('success'))
        <div class="w-full flex items-center justify-center">
            <div
                class="w-full bg-green-600 p-5 rounded-lg drop-shadow-2xl grid grid-cols-5 gap-2 mb-2">
                <div class="col-span-4 flex items-center pl-3">
                    <span class="error text-white">{{ session('success') }}</span>
                </div>
                <div class="col-span-1 flex items-center justify-end pr-3 text-right">
                    <button tclass="p-2 rounded-full hover:bg-gray-100" wire:click="">
                        <svg style="width: 26px;height:26px;color: purple;" xmlns="http://www.w3.org/2000/svg"
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

    <div class="">
        <x-label for="name" value="{{ __('Warehouse') }}"/>
        <select wire:model="warehouse_id" class="block mt-1 w-full" type="text" name="warehouse_id" :value="old('warehouse_id')">
            <option value="">{{ __("Select") }}</option>
            @foreach($warehouses as $warehouse)
                <option @if($warehouse->id==$warehouse_id) selected
                        @endif value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-4">
        <x-label for="name" value="{{ __('In-Kind Donation Type') }}"/>
        <select wire:model="in_kind_donation_id" class="block mt-1 w-full" type="text" name="in_kind_donation_id" :value="old('in_kind_donation_id')">
            <option value="">{{ __("Select") }}</option>
            @foreach($in_kind_donations as $in_kind_donation)
                <option @if($in_kind_donation->id==$in_kind_donation_id) selected
                        @endif value="{{ $in_kind_donation->id }}">{{ $in_kind_donation->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-4 text-right">
        <x-button wire:click="save">{{ __('Save') }}</x-button>
    </div>

</div>
