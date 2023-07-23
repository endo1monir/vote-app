<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use http\Client\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status = 'All';
    public $statusCount;

    public function setStatus($newStatus)
    {

        $this->status = $newStatus;
        $this->emit('queryStringUpdatedStatus', $this->status);
        if ($this->getPreviousRouteName() == 'idea.show')
            $this->redirect(\route('idea.index', ['status' => $newStatus]));

    }

    private function getPreviousRouteName()
    {
        return
            app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }

    public function mount()
    {
        $this->statusCount = Status::getCount();
        $this->status = \request()->status ?? "All";
        if (Route::currentRouteName() == 'idea.show'):
            $this->status = null;
//            $this->queryString = []; // reset the query string
        endif;
    }

    public function render()
    {
        return view('livewire.status-filters');
    }
}
