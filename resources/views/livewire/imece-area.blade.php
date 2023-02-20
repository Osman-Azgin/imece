<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="block h-12 w-auto"/>

        <h1 class="mt-8 text-2xl font-medium text-gray-900">

        </h1>

        <p class="mt-6 text-gray-500 leading-relaxed">
            {{ __('Current requirements') }}
        </p>
    </div>

    <div wire:poll.5s="loadRequirements" class="bg-gray-200 bg-opacity-25 p-6 lg:p-8">
        @foreach($currentRequirements as $requirement)
            <div class="w-full p-4 md:p-8 grid grid-cols-5 border-b">
                <div>
                    {{ $requirement->inkindDonation->name }}
                </div>
                <div>
                    {{ $requirement->warehouse->team->name }}
                </div>
                <div>
                    {{ $requirement->warehouse->name }}
                </div>
                <div>
                    {{ $requirement->warehouse->address->district->name }}
                    /{{ $requirement->warehouse->address->city->name }}
                </div>
                <div class="col-span-1 flex items-center justify-end">
                    <button type="button" wire:click="detail({{ $requirement->id }})">
                        <svg style="width: 50px;color: purple;" xmlns="http://www.w3.org/2000/svg" fill="none"
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
