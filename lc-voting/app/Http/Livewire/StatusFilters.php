<?php

namespace App\Http\Livewire;

use http\Client\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class StatusFilters extends Component
{
    public $status = 'all';
    protected $queryString = ['status'];

    public function setStatus($newStatus)
    {

        $this->status = $newStatus;
        if($this->getPreviousRouteName()=='idea.show')
        $this->redirect(\route('idea.index', ['status' => $newStatus]));

    }

    private function getPreviousRouteName()
    {
        return
            app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }

    public function mount()
    {
        if (Route::currentRouteName() == 'idea.show'):
            $this->status = null;
            $this->queryString = []; // reset the query string
        endif;
    }

    public function render()
    {
        return view('livewire.status-filters');
    }
}
