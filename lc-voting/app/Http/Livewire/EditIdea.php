<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class EditIdea extends Component
{
    public $idea;
    public $title;
    public $category;
    public $description;

    protected $rules = [
        'title' => 'required|string|between:3,255',
        'category' => 'integer|exists:categories,id|required',
        'description' => 'required|string'
    ];

    public function mount($idea)
    {
        $this->idea = $idea;
        $this->title = $idea->title;
        $this->category = $idea->category_id;
        $this->description = $idea->description;
    }

    public function updateIdea()
    {
        if (auth()->guest() ||auth()->user()?->cannot('update', $this->idea)) {
            abort(403);
        }
        $this->validate();
        $this->idea->update([
            'title' => $this->title,
            'category_id' => $this->category,
            'description' => $this->description,
        ]);
        $this->emit('ideaWasUpdated','idea updated successfully !');
    }

    public function render()
    {
        return view('livewire.edit-idea', [
            'categories' => Category::all()
        ]);
    }
}
