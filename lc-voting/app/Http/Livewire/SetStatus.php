<?php

namespace App\Http\Livewire;


use App\Jobs\NotifyAllVoters;
use App\Mail\IdeaStatusUpdatedMailable;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Http\Response as Response;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $notifyAllVoters;
    public $comment;

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
            NotifyAllVoters::dispatch($this->idea);
        Comment::create(
            [
                'user_id' => auth()->id(),
                'idea_id' => $this->idea->id,
                'status_id' => $this->status,
                'body' => $this->comment ?? 'No comment provided',
                'is_status_update' =>true,
            ]
        );
        $this->reset('comment');
        $this->emit('statusWasUpdated', 'the status of the idea was updated');
    }

    public function notifyAllVoters()
    {


    }

    public function render()
    {
        return view('livewire.set-status');
    }
}
