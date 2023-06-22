<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea;
    public $votesCount;
    public $hasVoted;

    public function mount($idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
//    $this->hasVoted = $idea->isVotedByUser(auth()->user());
        $this->hasVoted = $idea->voted_by_user;
    }

    public function vote()
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'));
        }
        if ($this->hasVoted) {
            $this->idea->removeVote(auth()->user());
            $this->hasVoted = false;
            $this->votesCount--;
        }else{
            $this->idea->vote(auth()->user()); //add vote
            $this->hasVoted = true;
            $this->votesCount++;
        }

    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}
