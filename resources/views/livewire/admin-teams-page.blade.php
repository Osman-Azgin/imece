<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage All Teams') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <h1>Kuruluşlar</h1>
                </div>
                <div class="bg-white border-b border-gray-200">
                    <div class="bg-gray-200 bg-opacity-25">
                        <table class="table-auto w-full">
                            <thead>
                            <tr class="border-b">
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ __('Organization Name') }}</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ __('Organization Type') }}</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ __('What it can do?') }}</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ __('Number of users') }}</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ __('Status') }}</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">{{ __('Created at') }}</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $team)
                                <tr class="border-b">
                                    <td class="text-sm text-gray-900 px-6 py-4 text-left">{{ $team->name }}</td>
                                    <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                        @if($team->type=1)
                                            {{ __('Non-Goverment')  }}
                                        @elseif($team->type=2)
                                            {{ __('Commercial')  }}
                                        @elseif($team->type=3)
                                            {{ __('Goverment')  }}
                                        @endif
                                    </td>
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
                                    <td class="text-sm text-gray-900 px-6 py-4 text-left"> {{ DB::table('team_user')->where("team_id",$team->id)->count()+1 }} </td>
                                    <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                        @if($team->verified)
                                            <span class="text-green-400">{{ __('Verified') }}</span>
                                        @elseif(!$team->verified and $team->has_documents)
                                            <span class="text-yellow-500">{{ __('Waiting for verification') }}</span>
                                        @elseif(!$team->verified and !$team->has_documents)
                                            <span class="text-red-400">{{ __('Has not documents yet') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-sm text-gray-900 px-6 py-4 text-left"> {{ $team->created_at }} </td>
                                    <td class="text-sm text-gray-900 px-6 py-4 text-left">
                                        <x-secondary-button wire:click="detail({{ $team->id }})">
                                            <svg style="width: 50px;color: purple;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                            </svg>
                                        </x-secondary-button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    @for($i=0;$i<ceil($teams_filtered_count/$per_page);$i++)
                        <x-button wire:click="changePage({{$i+1}})">{{ $i+1 }}</x-button>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
