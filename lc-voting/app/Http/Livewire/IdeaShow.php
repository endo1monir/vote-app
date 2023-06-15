<?php

namespace App\Http\Livewire;

use Livewire\Component;

class IdeaShow extends Component
{
    public $idea;
    public $votesCounts;
    public function mount($idea,$votesCounts)
    {
        $this->idea = $idea;
        $this->votesCounts = $votesCounts;
    }
    public function render()
    {
        return view('livewire.idea-show');
    }
}
