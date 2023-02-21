<div class="w-full">

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

    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-0">
            <table class="table-auto w-full">
                <tbody>
                <tr class="border-b">
                    <td class="text-sm text-gray-900 px-6 py-4 text-left">
                        <x-label>{{ __('Organization') }}</x-label>
                        {{ $requirement->warehouse->team->name }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="text-sm text-gray-900 px-6 py-4 text-left">
                        <x-label>{{ __('Organization\'s warehouse name') }}</x-label>
                        {{ $requirement->warehouse->name }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="text-sm text-gray-900 px-6 py-4 text-left">
                        <x-label>{{ __('In-Kind donation type') }}</x-label>
                        {{ $requirement->inkindDonation->name }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="text-sm text-gray-900 px-6 py-4 text-left">
                        <x-label>{{ __('Organization\'s warehouse address') }}</x-label>
                        {{ $requirement->warehouse->address->neighborhood->name }} {{ $requirement->warehouse->address->district->name }}
                        /{{ $requirement->warehouse->address->city->name }} {{ $requirement->warehouse->address->country->name }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="text-sm text-gray-900 px-6 py-4 text-left">
                        <x-label>{{ __('Organization\'s officer') }}</x-label>
                        {{ $requirement->warehouse->team->owner->name }}<br/>
                        {{ $requirement->warehouse->team->owner->email }}<br/>
                        {{ $requirement->warehouse->team->owner->phone }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div wire:ignore id="mapContainer" class="w-full border-b h-full" style="min-height: 50vh"></div>
        </div>
    </div>

    @if($requirement->warehouse->latitude && $requirement->warehouse->longitude)
        <script>
            function myMap() {
                var mapProp = {
                    center: new google.maps.LatLng(0, 0),
                    zoom: 6,
                };
                var map = new google.maps.Map(document.getElementById("mapContainer"), mapProp);

                placeMarkerAndPanTo(new google.maps.LatLng({{ $requirement->warehouse->latitude }}, {{ $requirement->warehouse->longitude }}), map);
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

            window.onload = setTimeout(myMap, 200);
        </script>
    @endif
</div>
