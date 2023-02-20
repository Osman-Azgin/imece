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
                    <div class="col-span-1 flex items-center">
                        <button class="p-2 rounded-full hover:bg-gray-100" wire:click="back" class="mr-4">
                            <svg style="width: 26px;height:26px;color: black;" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75"/>
                            </svg>
                        </button>
                        {{ ($warehouse->name) ? $warehouse->name : __('New warehouse') }}
                    </div>
                    <div class="col-span-1 text-right">
                        @if($warehouse->id)
                            <x-danger-button wire:click="$toggle('delete_modal')"> {{ __('Delete Warehouse') }} </x-danger-button>
                        @endif
                    </div>
                </div>
                <div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8 flex items-center justify-center">
                    <div wire:submit.prevent="save" class=" w-full md:w-3/4">

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

                        <div class="">
                            <x-label for="name" value="{{ __('Warehouse Name') }}"/>
                            <x-input id="name" wire:model="name" class="block mt-1 w-full" type="text" name="name"
                                     :value="old('name')" required autocomplete="name"/>
                        </div>

                        <div class="mt-4">
                            <h4>{{ __("Address")  }}</h4>
                        </div>

                        <div class="mt-4 grid grid-cols-1 gap-2 md:grid-cols-4 md:gap-4">

                            <div class="col-span-1">
                                <x-label for="country" value="{{ __('Country') }}*"/>
                                <select class="block mt-1 w-full" name="country" wire:model="country" id="country"
                                        wire:change="selectCountry">
                                    <option value="">{{ __("Select") }}</option>
                                    @foreach($countries as $singlecountry)
                                        <option @if($singlecountry->id==$country) selected
                                                @endif value="{{ $singlecountry->id }}">{{ $singlecountry->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1">
                                <x-label for="city" value="{{ __('City') }}*"/>
                                <select class="block mt-1 w-full" name="city" wire:model="city" id="city"
                                        wire:change="selectCity">
                                    <option value="">{{ __("Select") }}</option>
                                    @foreach($cities as $singlecity)
                                        <option @if($singlecity->id==$city) selected
                                                @endif value="{{ $singlecity->id }}">{{ $singlecity->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1">
                                <x-label for="district" value="{{ __('District') }}*"/>
                                <select class="block mt-1 w-full" name="district" wire:model="district" id="district"
                                        wire:change="selectDistrict">
                                    <option value="">{{ __("Select") }}</option>
                                    @foreach($districts as $singledistrict)
                                        <option @if($singledistrict->id==$district) selected
                                                @endif value="{{ $singledistrict->id }}">{{ $singledistrict->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1">
                                <x-label for="neighborhood" value="{{ __('Neighborhood') }}"/>
                                <select class="block mt-1 w-full" name="neighborhood" wire:model="neighborhood"
                                        id="neighborhood" wire:change="selectNeighborhood">
                                    <option value="">{{ __("Select") }}</option>
                                    @foreach($neighborhoods as $singleneighborhood)
                                        <option @if($singleneighborhood->id==$neighborhood) selected
                                                @endif value="{{ $singleneighborhood->id }}">{{ $singleneighborhood->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-1">
                                <x-label for="street" value="{{ __('Street') }}"/>
                                <select class="block mt-1 w-full" name="street" wire:model="street" id="street">
                                    <option value="">{{ __("Select") }}</option>
                                    @foreach($streets as $singlestreet)
                                        <option @if($singlestreet->id==$street) selected
                                                @endif value="{{ $singlestreet->id }}">{{ $singlestreet->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4">
                            <small>{{ __("Pick in map") }}</small>
                        </div>

                        <div class="mt-4">
                            <div wire:ignore id="mapContainer" class="w-full" style="height: 50vh"></div>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-2 md:grid-cols-4 md:gap-4">

                            <div class="col-span-1">
                                <x-label for="city" value="{{ __('Latitude') }}"/>
                                <x-input id="lat" class="block mt-1 w-full" type="number" name="lat" wire:model="lat"
                                         :value="old('lat')" required autocomplete="lat"/>
                            </div>

                            <div class="col-span-1">
                                <x-label for="district" value="{{ __('Longitude') }}"/>
                                <x-input id="lng" class="block mt-1 w-full" type="number" name="lng" wire:model="lng"
                                         :value="old('lng')" required autocomplete="lng"/>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="p-4 lg:p-6 bg-white border-t border-gray-200 grid grid-cols-2">
                    <h1 class="col-span-1"></h1>
                    <div class="col-span-1 text-right">
                        <x-secondary-button wire:click="back"> {{ __('Cancel') }} </x-secondary-button>
                        <x-button wire:click="save"> {{ __('Save') }} </x-button>
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

            <x-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                {{ __("Delete Warehouse") }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>


    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(0, 0),
                zoom: 2,
            };
            var map = new google.maps.Map(document.getElementById("mapContainer"), mapProp);

            map.addListener("click", (e) => {
                placeMarkerAndPanTo(e.latLng, map);
                @this.set('lat', e.latLng.lat());
                @this.set('lng', e.latLng.lng());
            });

            @if($lat && $lng)
            placeMarkerAndPanTo(new google.maps.LatLng({{ $lat }},{{ $lng }}), map);
            @endif
        }

        var marker = null;

        function placeMarkerAndPanTo(latLng, map) {
            if (marker != null) marker.setMap(null);
            marker = new google.maps.Marker({
                position: latLng,
                map: map,
            });
            map.panTo(latLng);
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5Mja5Pa696wsCwFp-waSokuWqQiBJVJ4&callback=myMap"></script>
</div>
