<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MarkIdeaAsNotSpam extends Component
{
    public $idea;

    public function mount($idea)
    {
        $this->idea = $idea;
    }

    public function markIdeaAsNotSpam()
    {
        if (auth()->guest() || !auth()->user()->isAdmin())
            abort(403);

        $this->idea->update([
            'spam_reports' => 0
        ]);
        $this->emit('MarkedAsNotSpam','Idea has been marked as not spam');
    }

    public function render()
    {
        return view('livewire.mark-idea-as-not-spam');
    }
}
