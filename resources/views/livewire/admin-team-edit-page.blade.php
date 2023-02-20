<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage All Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="p-4 lg:p-6 bg-white border-b border-gray-200 grid grid-cols-2">
                    <h1 class="col-span-1">{{ $team->name }}</h1>
                    <div class="col-span-1 text-right">
                        @if(!$team->verified)
                            <x-button wire:click="$toggle('verify_modal')"> {{ __('Verify') }} </x-button>
                        @else
                            <x-danger-button wire:click="$toggle('unverify_modal')"> {{ __('UnVerify') }} </x-danger-button>
                        @endif
                        <x-danger-button wire:click="$toggle('delete_modal')"> {{ __('Delete') }} </x-danger-button>
                    </div>
                </div>
                <div class="bg-white border-b border-gray-200">
                    <div class="bg-gray-200 bg-opacity-25">
                        <table class="table-auto w-full">
                            <tbody>
                            <tr class="border-b">
                                <td class="text-sm text-gray-900 px-6 py-4 text-left">{{ $team->name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                    @if($team->type=1)
                                        {{ __('Non-Goverment')  }}
                                    @elseif($team->type=2)
                                        {{ __('Commercial')  }}
                                    @elseif($team->type=3)
                                        {{ __('Goverment')  }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                    @foreach(\App\Models\TeamAbility::where("team_id",$team->id)->get() as $abl)
                                        <span>
                                                @if($abl->ability=="yardim-toplama-dagitma")
                                                {{ __('Aid collection/distribution')  }}
                                            @elseif($abl->ability=="lojistik")
                                                {{ __('Logistics')  }}
                                            @endif
                                            </span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                    @if($team->verified)
                                        <span class="text-green-400">{{ __('Verified') }}</span>
                                    @elseif(!$team->verified and $team->has_documents)
                                        <span class="text-yellow-500">{{ __('Waiting for verification') }}</span>
                                    @elseif(!$team->verified and !$team->has_documents)
                                        <span class="text-red-400">{{ __('Has not documents yet') }}</span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 lg:p-6 bg-white border-b border-gray-200">
                    <h1>{{ __('Officer') }}</h1>
                </div>
                <div class="bg-white border-b border-gray-200">
                    <div class="bg-gray-200 bg-opacity-25">
                        <table class="table-auto w-full">
                            <tbody>
                            <tr class="border-b">
                                <td class="text-sm text-gray-900 px-6 py-4 text-left">{{ $team->owner->name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-sm text-gray-900 px-6 py-4 text-left">{{ $team->owner->email }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="text-sm text-gray-900 px-6 py-4 text-left">{{ $team->owner->phone }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 lg:p-6 bg-white border-b border-gray-200">
                    <h1>{{ __('Documents') }}</h1>
                </div>
                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
                    <div class="min-h-full col-span-1">
                        @foreach($team->documents as $document)
                            <div class="w-full flex items-center justify-center">
                                <div class="md:w-3/4 w-full bg-white p-3 rounded-lg drop-shadow-2xl grid grid-cols-5 gap-2 mb-2">
                                    <div class="col-span-4 flex items-center pl-3">
                                        @if(strpos($document->filename,".png")!=false or strpos($document->filename,".jpg")!=false or strpos($document->filename,".jpeg")!=false)
                                            <svg style="width: 30px;color:purple;margin-right: 15px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                                <path strokeLinecap="round" strokeLinejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        @endif
                                        @if(strpos($document->filename,".pdf"))
                                            <svg style="width: 30px;color: mediumpurple;margin-right: 15px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                                <path strokeLinecap="round" strokeLinejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                            </svg>
                                        @endif
                                        {{ $document->filename }}
                                    </div>
                                    <div class="col-span-1 flex items-center justify-end pr-3">
                                        <button type="button" wire:click="showDocument('{{ $document->filename }}')">
                                            <svg style="width: 30px;color: purple;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>

                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if(count($team->documents)==0)
                            <h1 class="font-medium text-center">{{ __('No files Uploaded') }}</h1>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal wire:model="verify_modal">
        <x-slot name="title">
            {{ __("Verify Organization") }}
        </x-slot>

        <x-slot name="content">
            {{ __("Are you sure to verify this organization?") }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('verify_modal')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="verifyTeam" wire:loading.attr="disabled">
                {{ __("Verify Organization") }}
            </x-button>
        </x-slot>
    </x-confirmation-modal>

    <x-confirmation-modal wire:model="unverify_modal">
        <x-slot name="title">
            {{ __("UnVerify Organization") }}
        </x-slot>

        <x-slot name="content">
            {{ __("Are you sure to unverify this organization?") }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('unverify_modal')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-secondary-button>

            <x-button class="ml-2" wire:click="unverifyTeam" wire:loading.attr="disabled">
                {{ __("UnVerify Organization") }}
            </x-button>
        </x-slot>
    </x-confirmation-modal>

    <x-confirmation-modal wire:model="delete_modal">
        <x-slot name="title">
            {{ __("Delete Organization") }}
        </x-slot>

        <x-slot name="content">
            {{ __("Are you sure to delete this organization?") }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('delete_modal')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="removeTeam" wire:loading.attr="disabled">
                {{ __("Delete Organization") }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
