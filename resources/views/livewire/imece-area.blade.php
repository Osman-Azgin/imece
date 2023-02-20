<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="block h-12 w-auto"/>

        <h1 class="mt-8 text-2xl font-medium text-gray-900">

        </h1>

        <p class="mt-6 text-gray-500 leading-relaxed">
            {{ __('Current requirements') }}
        </p>
    </div>

    <div wire:poll.5s="loadRequirements" class="bg-gray-200 bg-opacity-25 p-4 md:p-8">
        @foreach($currentRequirements as $requirement)
            <div class="w-full p-3 md:p-6 grid grid-cols-4 md:grid-cols-5 bg-white rounded-lg items-center justify-center pl-1">
                <div class="flex items-center">
                    <svg style="width: 40px;height:40px;color:purple;margin-right: 15px;"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                    </svg>
                    {{ $requirement->inkindDonation->name }}
                </div>
                <div>
                    {{ $requirement->warehouse->team->name }}
                </div>
                <div class="">
                    {{ $requirement->warehouse->name }}
                </div>
                <div>
                    {{ $requirement->warehouse->address->district->name }}
                    /{{ $requirement->warehouse->address->city->name }}
                </div>
                <div class="col-span-1 flex items-center justify-end text-right">
                    <button class="p-2 rounded-full hover:bg-gray-100" type="button" wire:click="detail({{ $requirement->id }})">
                        <svg style="width: 30px;height:30px;color: purple;" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
