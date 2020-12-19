<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ConsumptionCycle;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class DiscConsume extends Component
{
    
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // public  $clients=[] ;
    public $query = '';
    protected $rules = [
        'query' => 'required|min:3',
    ];
    
 
    public function updateStatus($id, $status)
    {
        if ($this->id) {
            $record = ConsumptionCycle::find($id);
            $record->update([
                'label' => $status,
                'user_id' => Auth::id()
            ]);
            if ($status) {
                session()->flash('message', ' تم تفعيل الاشتراك للسيد ' . $record->full_name);
            } else {
                session()->flash('danger', '  تم ايقاف الاشتراك  للسيد ' . $record->full_name);
            }
        }
    }


  
    public function render()
    {
        $clients = ConsumptionCycle::Where('label', 0)->where('full_name', 'like', '%' . $this->query . '%')
        ->orderBy('full_name', 'asc')
        ->paginate(50);
        
        return view('livewire.disc-consume', ['clients' => $clients]);
    }
}
