<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\Livewire;

class EditComment extends Component
{
    public Comment $comment;
    public $body;

    protected $rules = [
        'body' => 'required|min:3'
    ];
    protected $listeners = ['setEditComment', 'setDeleteComment'];

    public function setEditComment($commentId)
    {

        $this->comment = Comment::findOrFail($commentId);
        $this->body = $this->comment->body;
        $this->emit('editCommentWasSet');
    }

    public function setDeleteComment($commentId)
    {
//    $this->comment=Comment::findOrFail($commentId);
//    $this->emit('deleteCommentWasSet');
    }

    public function updateComment()
    {
        if (auth()->guest() || auth()->user()->cannot('update', $this->comment)) {
            abort(403);
        }
        $this->validate();
        $this->comment->update(['body' => $this->body]);
        $this->emit('commentWasUpdated', 'the comment updated successfully !');;
    }

    public function render()
    {
        return view('livewire.edit-comment');
    }
}
