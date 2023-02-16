<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
    <div class="min-h-full col-span-1">
        @foreach($documents as $document)

        @endforeach
        @if(count($documents)==0)
            <h1 class="font-medium text-center">{{ __('No files Uploaded') }}</h1>
        @endif
    </div>
    <div class="flex items-center justify-center">
            <form x-data="{selected:null}" class="w-1/2 bg-white p-3 grid grid-cols-4 gap-2 rounded-lg drop-shadow-2xl">
                <div class="col-span-3 overflow-hidden">
                    <input x-ref="documentFile"
                           class=" hidden"
                           type="file"
                           accept="application/pdf,image/png,image/jpg"
                           x-on:change="$refs.fileNameShow.innerHTML=$refs.documentFile.files[0].name;"
                    />
                    <x-label>
                        <x-secondary-button type="button" x-on:click.prevent="$refs.documentFile.click()">{{ __("Select File")  }}</x-secondary-button>
                        <span x-ref="fileNameShow"></span>
                    </x-label>
                </div>
                <div class="col-span-1 text-right">
                    <x-button type="submit">{{ __('Upload') }}</x-button>
                </div>

            </form>

    </div>
</div>
