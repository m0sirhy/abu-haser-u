<div class="col-md-6 col-lg-6 col-11 mx-auto my-auto search-box mr-3">
    @role('super_admin')

    <div class="row ">

        @if($empty)

        <div class="col-6 col-sm-4 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: medium;">عدد الاشتراكات الغير مقرؤة</h5>
                    <h6 class="card-text text-center">{{$empty}}</h6>
                </div>
            </div>
        </div>
        @endif
        @if($wrong)
        <div class="col-6 col-sm-4 mx-auto ">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center" style="font-size: medium;"> عدد القراءات الخاطئة</h5>
                    <h6 class="card-text text-center"> {{$wrong}}</h6>
                </div>
            </div>
        </div>
        @endif
    </div>
    @endrole

    <div>
        @if (session()->has('message'))


        <div class="alert alert-success">
            {{ session('message') }}

        </div>
        @elseif(session()->has('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}

            </div>

        @endif
    </div>
    <div class="input-group form-container">
        <input type="text" name="search" wire:model="query" wire:keydown.escape="resett" wire:keydown.tab="resett" class="form-control search-input" placeholder="ادخل اسم للبحث" autofocus="autofocus" autocomplete="off" onclick="setBgToDark()">

        <span class="input-group-btn">
            <button class="btn btn-search" wire:click="resett" value="Reset">Reset
            </button>
        </span>
        @if(!empty($clients ) )

        <div class="dropdown-item bg-transparent" style="height: 250px; overflow-y: scroll; ">
            @foreach($clients as $i => $client)
            <form wire:keydown.enter.prevent="update({{$client->id}})">


                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">{{ $client->full_name }}</span>
                    <span class="input-group-text colmd" id="inputGroup-sizing-sm">{{ $client->address }}</span>
                    <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">{{ $client->previous }}</span>

                    @if($client->curent > 0 && $client->curent != NULL)
                    <span class="input-group-text  bg-primary text-white">{{$client->curent}}</span>
                    @endif
                    @if (auth()->user()->hasPermission('create_consume'))

                    <input type="number" autocomplete="off" wire:model.defer="curent" class="form-control no-border">
                    @if($client->label)
                    <span class="input-group-text bg-success text-white" wire:click.prevent.default="updateStatus({{$client->id}},false)" id="inputGroup-sizing-sm">فعال</span>

                    @else
                    <span class="input-group-text bg-danger text-white" wire:click.prevent.default="updateStatus({{$client->id}},true)" id="inputGroup-sizing-sm">مفصول</span>

                    @endif
                    <br>
                    <br>
                    <span class="input-group-text" id="inputGroup-sizing-sm"> {{$client->user->name }} </span>

                    <span class="input-group-text" id="inputGroup-sizing-sm"> {{ \Carbon\Carbon::parse($client->updated_at )->diffForHumans() }}</span>
                    @endif

                </div>
            </form>
            <div class="input-group input-group-sm mb-3">

            </div>
            @endforeach
        </div>
        @endif

    </div>