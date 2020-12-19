<?php

namespace App\Http\Livewire;

use App\ConsumptionCycle;
use App\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoadMoreConsumes extends Component
{
  
    public $perPage = 15;
    protected $listeners = [
        'load-more' => 'loadMore'
    ];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function loadMore()
    {
        $this->perPage = $this->perPage + 5;
    }
  
    public function render()
    {
        $users = User::latest()->paginate($this->perPage);

        $this->emit('userStore');
        return view('livewire.load-more-consumes',['users' => $users]);
    }
}
