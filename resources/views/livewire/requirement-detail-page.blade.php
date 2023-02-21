<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Manage requirements') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
            <div class="p-4 lg:p-6 bg-white border-b border-gray-200 grid grid-cols-2">
                <h1 class="col-span-1 flex items-center">
                    <button class="p-2 rounded-full hover:bg-gray-100" wire:click="back" class="mr-4">
                        <svg style="width: 30px;height:30px;color: black;" xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75"/>
                        </svg>
                    </button>
                    @if($requirement->id)
                        @if($requirement->warehouse_id)
                            @if($requirement->warehouse->team_id==Auth::user()->currentTeam->id)
                                {{ __('Your organization\'s requirements') }}
                            @else
                                {{ __('Requirement') }} #{{ $requirement->id }}
                            @endif
                        @endif
                    @else
                        {{ __('Create a new requirement') }}
                    @endif
                </h1>
                <div class="col-span-1 text-right">
                    @if($requirement->warehouse_id)
                        @if($requirement->warehouse->team_id==Auth::user()->currentTeam->id)
                            @if(!$imece)
                                <x-danger-button
                                    wire:click="$toggle('delete_modal')"> {{ __('Delete Requirement') }} </x-danger-button>
                            @endif
                        @else
                            @if(!$imece)
                                <x-button
                                    wire:click="$toggle('satisfy_modal')"> {{ __('Satisfy Requirement') }} </x-button>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
            <div class="bg-gray-200 bg-opacity-25 p-0 flex items-center justify-center">
                @if($requirement->warehouse_id)
                    @if($requirement->warehouse->team_id==Auth::user()->currentTeam->id)
                        <livewire:my-requirement-deail-area :requirement="$requirement"/>
                    @else
                        <livewire:requirement-deail-area :requirement="$requirement"/>
                    @endif
                @else
                    <livewire:my-requirement-deail-area :requirement="$requirement"/>
                @endif
            </div>
            @if($imece)
                <div class="p-4 lg:p-6 bg-white border-b border-gray-200 grid grid-cols-2">
                    <h1 class="col-span-1 flex items-center">
                        {{ __('Imece') }}
                    </h1>
                    <div class="col-span-1 text-right">
                    </div>
                </div>
                <div class="bg-gray-200 bg-opacity-25 p-0 flex items-center justify-center">
                    <div class="w-full">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                                <table class="table-auto w-full">
                                    <tbody>
                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                            <x-label>{{ __('Organization') }}</x-label>
                                            {{ $imece->warehouse->team->name }}
                                        </td>
                                    </tr>

                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                            <x-label>{{ __('Organization\'s warehouse name') }}</x-label>
                                            {{ $imece->warehouse->name }}
                                        </td>
                                    </tr>

                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                            <x-label>{{ __('Organization\'s warehouse address') }}</x-label>
                                            {{ $imece->warehouse->address->neighborhood->name }} {{ $imece->warehouse->address->district->name }}
                                            /{{ $imece->warehouse->address->city->name }} {{ $imece->warehouse->address->country->name }}
                                        </td>
                                    </tr>

                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                            <x-label>{{ __('Organization\'s officer') }}</x-label>
                                            {{ $imece->warehouse->team->owner->name }}<br/>
                                            {{ $imece->warehouse->team->owner->email }}<br/>
                                            {{ $imece->warehouse->team->owner->phone }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <div wire:ignore id="mapContainerSatisfier" class="w-full h-full" style="min-height: 50vh"></div>
                                </div>
                        </div>
                    </div>
                    @endif
                </div>
        </div>

        <x-confirmation-modal wire:model="delete_modal">
            <x-slot name="title">
                {{ __("Delete Requirement") }}
            </x-slot>

            <x-slot name="content">
                {{ __("Are you sure to delete this requirement?") }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('delete_modal')" wire:loading.attr="disabled">
                    {{ __("Cancel") }}
                </x-secondary-button>

                <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __("Delete Requirement") }}
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>

        <x-confirmation-modal wire:model="satisfy_modal">
            <x-slot name="title">
                {{ __("Satisfy Requirement") }}
            </x-slot>

            <x-slot name="content">
                @error('satisfy')
                <div class="w-full flex items-center justify-center">
                    <div
                        class="w-full bg-red-700 p-5 rounded-lg drop-shadow-2xl grid grid-cols-5 gap-2 mb-2">
                        <div class="col-span-4 flex items-center pl-3">
                            <span class="error text-white">{{ $message }}</span>
                        </div>
                        <div class="col-span-1 flex items-center justify-end pr-3 text-right">
                            <button type="submit" wire:click="removeSatisfyError">
                                <svg style="width: 30px;color: white;" xmlns="http://www.w3.org/2000/svg"
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
                {{ __("Please specify which warehouse will use for requirement satisfy") }}
                <select wire:model="warehouse_id" class="block mt-1 w-full" type="text" name="warehouse_id"
                        :value="old('warehouse_id')">
                    <option value="">{{ __("Select") }}</option>
                    @foreach($warehouses as $warehouse)
                        <option @if($warehouse->id==$warehouse_id) selected
                                @endif value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                    @endforeach
                </select>
                <br/>
                {{ __("Please specify deadline of requirement satisfy") }}
                <input type="date" wire:model.debounce.300ms="satisfy_date"
                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                       value="{{ Carbon\Carbon::parse($satisfy_date)->format('Y-m-d') }}">
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('satisfy_modal')" wire:loading.attr="disabled">
                    {{ __("Cancel") }}
                </x-secondary-button>

                <x-button class="ml-2" wire:click="satisfy" wire:loading.attr="disabled">
                    {{ __("Satisfy Requirement") }}
                </x-button>
            </x-slot>
        </x-confirmation-modal>

        @if($imece && $imece->warehouse->latitude && $imece->warehouse->longitude)
            <script>
                function satisfyMap() {
                    var mapProp = {
                        center: new google.maps.LatLng(0, 0),
                        zoom: 6,
                    };
                    var mapS = new google.maps.Map(document.getElementById("mapContainerSatisfier"), mapProp);

                    placeMarkerSAndPanTo(new google.maps.LatLng({{ $imece->warehouse->latitude }}, {{ $imece->warehouse->longitude }}), mapS);
                }

                var markerS = null;

                function placeMarkerSAndPanTo(latLng, map) {
                    if (markerS != null) markerS.setMap(null);
                    markerS = new google.maps.Marker({
                        position: latLng,
                        map: map,
                    });
                    map.panTo(latLng);
                }
            </script>
        @endif
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5Mja5Pa696wsCwFp-waSokuWqQiBJVJ4&callback=satisfyMap"></script>
    </div>
