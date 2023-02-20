<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <x-application-logo class="block h-12 w-auto" />

        <h1 class="mt-8 mt-4 text-2xl font-medium text-gray-900">
            {{ __("Your organization not verified yet!") }}
        </h1>

        @if(!Auth::User()->currentTeam->userHasPermission(Auth::User(),"administration"))
            <p class="mt-6 text-gray-500 leading-relaxed">
                {{ __('Your admin will upload your organization\'s documents and we will inspect this and activate your system.') }}
            </p>
        @else
            <div class="grid md:grid-cols-8 gap-4 grid-cols-1">
                <div class="col-span-6">
                    <p class="mt-6 text-gray-500 leading-relaxed">
                        {{ __('You must upload your organization\'s documents/papers and click "verify" to send documents to our team for verification.') }}
                    </p>
                </div>
                <div class="col-span-2 text-right">
                    @if(\Illuminate\Support\Facades\Auth::user()->currentTeam->has_documents)
                        <x-secondary-button disabled>{{ __("Submited to verification") }}</x-secondary-button>
                    @else
                        <x-button wire:click="sendToVerification">{{ __("Submit to verification") }}</x-button>
                    @endif
                </div>
            </div>

        @endif

    </div>
    @if(Auth::User()->currentTeam->userHasPermission(Auth::User(),"administration"))
        <livewire:team-documents />
    @endif
</div>

