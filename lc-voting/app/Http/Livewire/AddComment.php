<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;

class AddComment extends Component
{
    public $idea;
    public $comment;
    protected $rules = [
        'comment' => 'required|min:4'
    ];

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function AddComment()
    {
        $this->validate();
        Comment::create(
            [
                'idea_id'=>$this->idea->id,
                'user_id'=>auth()->id(),
                'status_id'=>1,
                'body'=>$this->comment
            ]
        );
        $this->emit('commentAdded','Comment Added Successfully !');
        $this->reset('comment');

    }

    public function render()
    {
        return view('livewire.add-comment');
    }
}
