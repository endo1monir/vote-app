<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class MarkCommentAsNotSpam extends Component
{
    protected $listeners = ['setMarkAsNotSpamComment'];
    public Comment $comment;

    public function setMarkAsNotSpamComment($commentId)
    {
        $this->comment = Comment::findorFail($commentId);
        $this->emit('MarkCommentAsNotSpamWasSet');
    }
    public function markCommentAsNotSpam(){
        $this->comment->spam_reports=0;
        $this->comment->save();
        $this->emit('commentWasMarkedAsNotSpam','comment marked as not spam');
    }

    public function render()
    {
        return view('livewire.mark-comment-as-not-spam');
    }
}
