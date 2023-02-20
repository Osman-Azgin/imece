<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 gap-6 lg:gap-8 p-6 lg:p-8">
    <div class="min-h-full col-span-1">
        @foreach($documents as $document)
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
                        <button type="button" wire:click="promptRemoveDocument({{ $document->id }},'{{ $document->filename }}')">
                            <svg style="width: 30px;color: red;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        @if(count($documents)==0)
            <h1 class="font-medium text-center">{{ __('No files Uploaded') }}</h1>
        @endif

        @error('documentFile')
            <div class="w-full flex items-center justify-center">
                <div class="md:w-3/4 w-full bg-red-700 p-5 rounded-lg drop-shadow-2xl grid grid-cols-5 gap-2 mb-2">
                    <div class="col-span-4 flex items-center pl-3">
                        <span class="error text-white">{{ $message }}</span>
                    </div>
                    <div class="col-span-1 flex items-center justify-end pr-3">
                            <button type="submit" wire:click="removeDocumentError">
                                <svg style="width: 30px;color: white;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                    </div>
                </div>
            </div>
        @enderror
    </div>
    <div class="flex items-center justify-center">
            <form wire:submit.prevent="addDocument"
                  x-data="{documentFileName:null,isUploading: false, progress: 0}"
                  x-on:livewire-upload-start="isUploading = true"
                  x-on:livewire-upload-finish="isUploading = false"
                  x-on:livewire-upload-error="isUploading = false"
                  x-on:livewire-upload-progress="progress = $event.detail.progress"
                  class="md:w-1/2 w-full bg-white p-3 grid grid-cols-4 gap-2 rounded-lg drop-shadow-2xl">
                <div class="col-span-3 overflow-hidden">
                    <input x-ref="documentFile"
                           wire:model="documentFile"
                           class="hidden"
                           type="file"
                           accept="application/pdf,image/png,image/jpg"
                    />
                    <x-label>
                        <x-secondary-button type="button" x-on:click.prevent="$refs.documentFile.click()">{{ __("Select file") }}</x-secondary-button>

                        @if($documentFile!=null) <span> {{ $documentFile->getClientOriginalName() }} </span> @endif

                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </x-label>
                </div>
                <div class="col-span-1 text-right">
                    <x-button type="submit">{{ __('Add') }}</x-button>
                </div>
            </form>
    </div>

    <x-confirmation-modal wire:model="removeDocumentModal">
        <x-slot name="title">
            {{ __("Delete Document") }}
        </x-slot>

        <x-slot name="content">
            {{ __("Are you sure to delete this document?") }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('removeDocumentModal')" wire:loading.attr="disabled">
                {{ __("Cancel") }}
            </x-secondary-button>

            <x-danger-button class="ml-2" wire:click="removeDocument({{ $currentRemoveDocumentId }})" wire:loading.attr="disabled">
                {{ __("Delete Document") }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
