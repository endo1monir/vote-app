<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class DeleteIdea extends Component
{
    public $idea;


    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function deleteIdea()
    {
//        $this->idea->delete();
        if( auth()->guest() ||auth()->user()->cannot('delete',$this->idea))
            abort(403);
        Idea::destroy($this->idea->id);
//        $this->emit('ideaWasDeleted');
        return redirect()->route('idea.index');
    }

    public function render()
    {
        return view('livewire.delete-idea');
    }
}
