<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" x-data="{orgType:null}">
            @csrf

            <div class="mt-4">
                <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600 text-center">{{__('Your Organization')}}</h2>
            </div>

            <div class="mt-4">
                <x-label for="org_name" value="{{ __('Organization Name') }}" />
                <x-input id="org_name" class="block mt-1 w-full" type="text" name="org_name" :value="old('org_name')" required autofocus autocomplete="org_name" />
            </div>

            <div class="mt-4">
                <x-label for="org_type" value="{{ __('Organization Type') }}" />
                <select id="org_type" class="block mt-1 w-full" name="org_type" x-ref="org_type" x-on:change="
                        orgType=$refs.org_type.value;
                        ">
                    <option value="">{{ __("Select") }}</option>
                    <option value="1">{{ __("Non-Goverment") }}</option>
                    <option value="2">{{ __("Commercial") }}</option>
                    <option value="3">{{ __("Goverment") }}</option>
                </select>
            </div>

            {{--
            <div x-show="orgType==1" class="mt-4">
                <div x-data="{fileName: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                           wire:model="doc_stk"
                           x-ref="doc_stk"
                           name="doc_stk"
                           x-on:change="fileName = $refs.doc_stk.files[0].name;$refs.doc_stk_filename.innerHTML=fileName;"
                           bind:disabled="orgType!=1"
                    />

                    <x-label for="doc_stk" value="{{ __('Non-Goverment Organization Documents') }}"/>

                    <span x-ref="doc_stk_filename" x-show="fileName"></span>

                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.doc_stk.click()">
                        {{ __('Select Non-Goverment Organization Document PDF/Image') }}
                    </x-secondary-button>

                    <x-input-error for="doc_stk" class="mt-2"/>
                </div>
            </div>

            <div x-show="orgType==2" class="mt-4">
                <div x-data="{fileName: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                           wire:model="doc_vl"
                           x-ref="doc_vl"
                           name="doc_vl"
                           x-on:change="fileName = $refs.doc_vl.files[0].name;$refs.doc_vl_filename.innerHTML=fileName;"
                           bind:disabled="orgType!=2"
                    />

                    <x-label for="doc_stk" value="{{ __('Company Papers') }}"/>

                    <span x-ref="doc_vl_filename" x-show="fileName"></span>

                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.doc_vl.click()">
                        {{ __('Select Company Papers PDF/Image') }}
                    </x-secondary-button>

                    <x-input-error for="doc_vl  " class="mt-2"/>
                </div>
            </div>

            <div x-show="orgType==3" class="mt-4">
                <div x-data="{fileName: null}" class="col-span-6 sm:col-span-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden"
                           wire:model="doc_dd"
                           x-ref="doc_dd"
                           name="doc_dd"
                           x-on:change="fileName = $refs.doc_dd.files[0].name;$refs.doc_dd_filename.innerHTML=fileName;"
                           bind:disabled="orgType!=3"
                    />

                    <x-label for="doc_dd" value="{{ __('Decision Document') }}"/>

                    <span x-ref="doc_dd_filename" x-show="fileName"></span>

                    <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.doc_dd.click()">
                        {{ __('Select Decision Document PDF/Image') }}
                    </x-secondary-button>

                    <x-input-error for="doc_dd  " class="mt-2"/>
                </div>
            </div>
            --}}

            <div class="mt-4">
                <x-label value="{{ __('What you can do?') }}" />
            </div>

            <div class="mt-4">
                <x-label for="yardim-toplama-dagitma">
                    <input type="checkbox" id="yardim-toplama-dagitma" name="yardim-toplama-dagitma" value="1" :checked="old('yardim-toplama-dagitma')" />
                    {{ __('Aid collection/distribution') }}
                </x-label>
            </div>

            <div class="mt-4">
                <x-label for="lojistik" >
                    <input type="checkbox" id="lojistik" name="lojistik" value="1" :checked="old('lojistik')" />
                    {{ __('Logistics') }}
                </x-label>
            </div>

            <div class="mt-4">
                <h2 class="font-medium leading-tight text-4xl mt-0 mb-2 text-blue-600 text-center">{{__('Officer')}}</h2>
            </div>

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Phone') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="phone" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
