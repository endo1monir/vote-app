<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $votesCounts;
    public $hasVoted;

    public function mount($idea, $votesCounts)
    {
//        dd(auth()->user()->id);
        $this->idea = $idea;
        $this->votesCounts = $votesCounts;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function vote()
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'));
        }
        if ($this->hasVoted) {
            $this->idea->removeVote(auth()->user());
            $this->hasVoted = false;
            $this->votesCounts--;
        } else {
            $this->idea->vote(auth()->user()); //add vote
        $this->hasVoted = true;
        $this->votesCounts++;
        }
    }

    public function render()
    {
        return view('livewire.idea-show');
    }
}
