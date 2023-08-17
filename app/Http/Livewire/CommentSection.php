<?php

namespace App\Http\Livewire;

use App\Comment;
use App\Lesson;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentSection extends Component
{
    public $lesson;
    public $comments;
    public $newComment;

    public function mount(Lesson $lesson)
    {
        $this->lesson = $lesson;
        $this->refreshComments();
    }

    public function render()
    {
        return view('livewire.comment-section');
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|min:3|max:600',
        ]);

        $comment = new Comment([
            'content' => $this->newComment,
        ]);
        $comment->user_id = Auth::id();
        $this->lesson->comments()->save($comment);

        $this->newComment = '';
        $this->refreshComments();
    }

    public function refreshComments()
    {
        $this->comments = $this->lesson->comments()->with('user')->latest()->get();
    }
}
