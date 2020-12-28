<?php

namespace App\Http\Livewire;

use App\ConsumptionCycle;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Illuminate\Http\Request;

class ShowConsume extends Component
{
    public  $curent;
    public  $clients = [];
    public $query = '';

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

            $this->reset('curent','clients','query');

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
            $this->reset('clients');
        }
    }

    public function render()
    {

        $this->clients = ConsumptionCycle::where('full_name', 'like', '%' . $this->query . '%')
            ->limit(25)
            ->get();
            $total=ConsumptionCycle::where('curent','>',0)->get()->sum('consume');

        return view('livewire.show-consume',compact('total'));
    }

}
