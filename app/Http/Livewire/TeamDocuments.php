<?php

namespace App\Http\Livewire;

use App\Models\TeamDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use DB;

class TeamDocuments extends Component
{
    use WithFileUploads;
    public $documents=[];

    public $documentFile=null;

    public $currentRemoveDocumentId=null;
    public $currentRemoveDocumentFilename=null;
    public $removeDocumentModal=false;

    public function mount(){
        $this->documents=Auth::user()->currentTeam->documents;
    }

    public function addDocument(){
        if (!$this->documentFile){
            $this->addError('documentFile', __('Plesase select file!'));
            return;
        }

        if (count($this->documents)>=10){
            $this->addError('documentFile', __('Maximum 10 files accepted!'));
            return;
        }

        $this->validate([
            'documentFile' => 'required|mimes:jpeg,png,pdf|max:1024', // 1MB Max
        ]);

        $this->documentFile->storeAs('team_documents',time()."-".$this->documentFile->getClientOriginalName(),"local");

        $teamDocDB=new TeamDocument();
        $teamDocDB->team_id=Auth::user()->currentTeam->id;
        $teamDocDB->filename=time()."-".$this->documentFile->getClientOriginalName();
        $teamDocDB->uri=storage_path("app/team_documents/".time()."-".$this->documentFile->getClientOriginalName());
        $teamDocDB->save();

        $this->documents=Auth::user()->currentTeam->documents;

        $this->documentFile=null;
    }

    public function removeDocumentError(){
        $this->resetErrorBag('documentFile');
    }

    public function promptRemoveDocument($id,$filename){
        $this->currentRemoveDocumentId=$id;
        $this->currentRemoveDocumentFilename=$filename;
        $this->removeDocumentModal=true;
    }
    public function removeDocument($id){
        $file=TeamDocument::where("team_id",Auth::user()->currentTeam->id)->where("id",$id);
        if ($file->count()==0){
            return;
        }
        DB::beginTransaction();
        try {
            $file=$file->first();
            Storage::delete("team_documents/".$file->filename);
            $file->delete();
            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
        }
        $this->documents=Auth::user()->currentTeam->documents;
        $this->currentRemoveDocumentId=null;
        $this->currentRemoveDocumentFilename=null;
        $this->removeDocumentModal=false;
    }

    public function render()
    {
        return view('livewire.team-documents');
    }
}
