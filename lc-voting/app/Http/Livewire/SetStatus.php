<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Illuminate\Http\Response as Response;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $notifyAllVoters;

    public function mount($idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
    }

    public function setStatus()
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }
        $this->idea->status_id = $this->status;
        $this->idea->save(); //save the idea
        if ($this->notifyAllVoters)
            $this->notifyAllVoters();
        $this->emit('statusWasUpdated');
    }

    public function notifyAllVoters()
    {
        $voters=$this->idea->votes()->select(
            'name','email'
        )->get()->first()->name;
        dd($voters);
    }

    public function render()
    {
        return view('livewire.set-status');
    }
}
