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

    public function mount($idea)
    {
        $this->idea = $idea;
        $this->title = $idea->title;
        $this->category = $idea->category_id;
        $this->description = $idea->description;
    }

    public function updateIdea()
    {
        $this->idea->update([
            'title' => $this->title,
            'category_id' => $this->category,
            'description' => $this->description,
        ]);
    }

    public function render()
    {
        return view('livewire.edit-idea', [
            'categories' => Category::all()
        ]);
    }
}
