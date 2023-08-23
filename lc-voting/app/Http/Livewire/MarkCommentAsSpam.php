<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class MarkCommentAsSpam extends Component
{
    protected $listeners = ['setMarkAsSpamComment', 'SpamComment'];

    public Comment $comment;

    public function setMarkAsSpamComment($commentId)
    {
        $this->comment = Comment::findOrFail($commentId);
        $this->emit('MarkCommentAsSpamWasSet');
    }

    public function SpamComment()
    {
        $this->comment->spam_reports++;
        $this->comment->save();
        $this->emit('commentWasMarkedAsSpam' ,'comment spammed successfully !');
    }

    public function render()
    {
        return view('livewire.mark-comment-as-spam');
    }
}
