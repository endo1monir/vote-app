<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class DeleteComment extends Component
{
    public ?Comment $comment;
    protected $listeners = ['setDeleteComment'];

    public function setDeleteComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);
        $this->emit('deleteCommentWasSet');
    }

    public function deleteComment()
    {
        if (auth()->user()->can('delete', $this->comment)):
            Comment::destroy($this->comment->id);
        $this->comment = null;
            $this->emit('commentWasDeleted', 'Comment deleted successfully !');
        endif;
    }

    public function render()
    {
        return view('livewire.delete-comment');
    }
}
