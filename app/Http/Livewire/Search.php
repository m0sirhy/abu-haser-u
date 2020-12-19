<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\ConsumptionCycle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Search extends Component
{

    public $query, $clients, $curent, $wrong, $empty;

    protected $rules = [
        'query' => 'required|min:1',
    ];
    protected $listeners =['updateStatus'=>'$refresh'];
    public function mount()
    {
        $this->clients = [];
        $this->query = '';
    }

    public function resett()
    {
        $this->reset([ 'curent','clients']);
    }
    public function updatedQuery()
    {
        $this->validate();

        $this->clients = ConsumptionCycle::
        where('full_name', 'like', '%' . $this->query . '%')
            ->limit(5)
            ->get();
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
                session()->flash('message', ' تم تفعيل الاشتراك للسيد ' .$record->full_name );
            }else{
            session()->flash('danger', '  تم ايقاف الاشتراك  للسيد '.$record->full_name );
            }
            $this->resett();
            $this->reset('curent','clients','query');
        }
    }

    public function render()
    {
        $this->empty = ConsumptionCycle::Where('curent', 0)->count();

        $this->wrong = ConsumptionCycle::select('id')
            ->from('consumption_cycles')
            ->where('curent', '!=', 0)
            ->whereColumn('curent', '<', 'previous')->count();
        return view('livewire.search');
    }
}
