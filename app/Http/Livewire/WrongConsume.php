<?php

namespace App\Http\Livewire;

use App\ConsumptionCycle;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class WrongConsume extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    // public  $clients=[] ;
    public $query = '';
    public  $curent;

    protected $rules = [
        'query' => 'required|min:3',
    ];

    public function mount()
    {
        $this->clients = [];
    }
    public function update($id)
    {

        if ($this->id) {
            $record = ConsumptionCycle::find($id);
            $record->update([
                'curent' => $this->curent,
                'user_id' => Auth::id()
            ]);
            $consume =  $record->curent - $record->previous;
            session()->flash('message', ' " :تمت اضافة قراءة للسيد ' . $record->full_name . " كمية الاستهلاك " . $consume . "كيلو واط");

            $this->reset('curent',  'query');
        }
    }

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


        $clients = ConsumptionCycle::select('*')
            ->from('consumption_cycles')
            ->where('curent', '!=', 0)
            ->whereColumn('curent', '<', 'previous')->latest()
            ->with('user')
            ->paginate(50);
        return view('livewire.wrong-consume', ['clients' => $clients]);
    }
}
