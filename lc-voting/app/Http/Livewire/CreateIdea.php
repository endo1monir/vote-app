<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use Illuminate\Support\Facades\Response;
use Livewire\Component;

class CreateIdea extends Component
{
    public $title;
    public $category = 1;
    public $description;
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:3|max:255',
        'category' => 'required|integer|exists:categories,id'
    ];

    public function createIdea()
    {
//        dd('endo');
        if (auth()->check()) {
            $this->validate();
            Idea::create(
                [
                    'user_id' => auth()->user()->id,
                    'category_id' => $this->category,
                    'status_id' => 1,
                    'title' => $this->title,
                    'description' => $this->description,
                ]
            );
            session()->flash('success_message', 'Idea Created Successfully');
            $this->reset('title', 'description');
            return redirect()->route('idea.index');
        }
        abort(403);
    }

    public function render()
    {
        return view('livewire.create-idea',
            [
                'categories' => Category::all(),
            ]);
    }
}
