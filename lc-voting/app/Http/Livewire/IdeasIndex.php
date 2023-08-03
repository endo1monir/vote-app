<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Vote;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public $status = "All";
    public $category;
    public $filter;
    public $search;
    protected $queryString = ['status', 'category', 'filter','search'];
    protected $listeners = ['queryStringUpdatedStatus'];

    public function queryStringUpdatedStatus($newStatus)
    {
        $this->resetPage();
        $this->status = $newStatus;
    }

    public function updatedFilter()
    {
        if ($this->filter == 'My Ideas') {
            if (!auth()->check()) {
                return redirect()->route('login');
            }
        }
    }

    public function mount()
    {
        $this->status = request()->status ?? 'All';
    }

    public function render()
    {
        $statuses = Status::all()->pluck('id', 'name');
        $categories = Category::all();
        return view('livewire.ideas-index', [
            'Ideas' => Idea::with(['user', 'category', 'status'])
                ->when($this->status != 'All', function ($query, $status) use ($statuses) {
                    $query->where('status_id', $statuses->get($this->status));
                })
                ->when($this->category && $this->category != 'All Categories', function ($query) use ($categories) {
                    $query->where('category_id', $categories->pluck('id', 'name')->get($this->category));
                })
                ->when($this->filter && $this->filter == 'Top Voted', function ($query) {
                    $query->orderBy('votes_count', 'desc');
                })
                ->when($this->filter && $this->filter == 'My Ideas', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->when($this->filter && $this->filter=='Spam Ideas',function ($query){
                    return $query->where('spam_reports','>',0);
                })
                ->when($this->search ,function ($query){
                    $query->where('title','like','%'.$this->search.'%');
                })
                ->addSelect(['voted_by_user' => Vote::select('id')
                    ->where('user_id', auth()->check() ? auth()->user()->id : '')
                    ->whereColumn('idea_id', 'ideas.id')
                ])
                ->withCount('votes')
                ->orderBy('id', 'desc')->simplePaginate(10)
            ,
            'categories' => $categories]);
    }
}
