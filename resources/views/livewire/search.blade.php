<div class="col-md-6 col-lg-6 col-11 mx-auto my-auto search-box mr-3">
<div>
	@if (session()->has('message')) 
	<div class="alert alert-success">
		{{ session('message') }}
		<style onload="example2()"> </style>
	</div>
	@elseif(session()->has('danger')) 
	<div class="alert alert-danger"> {{ session('danger') }} </div>
	@endif
</div>
<button onclick="myFunction()" type="button" class="form-control form-control-sm btn btn-sm btn-success">طريقة البحث</button>
<div class="input-group form-container">
	<input type="text" id="search" name="search" wire:model.debounce.600ms="query" wire:keydown.escape="resett" wire:keydown.tab="resett" class="form-control search-input" placeholder="ادخل اسم للبحث" autofocus="autofocus" autocomplete="off" onclick="setBgToDark()"> 
	<select id="address" style="display: none;" wire:model="address" class="form-control search-input">
		//ad for adresses @foreach ($ad as $a) 
		<option value="{{$a}}">{{$a}}
		</option>
		@endforeach 
		<option value="" selected>البحث حسب العنوان </option>
	</select>
	<span class="input-group-btn"> <button class="btn btn-search" onclick="resetSearch();" value="Reset">Reset </button>
	</span> @if(!empty($clients ) ) 
	<div class="dropdown-item bg-transparent" style="height: 250px; overflow-y: scroll; ">
		@foreach($clients as $i => $client) 
			<div class="input-group input-group-sm mb-3">
                 <span class="input-group-text" id="inputGroup-sizing-sm">{{ $client->full_name }}</span>
				<span class="input-group-text colmd" id="inputGroup-sizing-sm">{{ $client->address }}</span> 
                <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-sm">{{ $client->previous}}</span> 
                @if($client->curent > 0 && $client->curent != NULL) 
                <span class="input-group-text bg-primary text-white">{{$client->curent}}</span>
                 @endif 
                @if(auth()->user()->hasPermission('create_consume'))
                 <input type="number" autocomplete="off" wire:keydown.enter="update({{$client->id}})" wire:model.defer="curent" class="form-control no-border"> @if($client->label) <span class="input-group-text bg-success text-white" wire:click.prevent.default="updateStatus({{$client->id}},false)" id="inputGroup-sizing-sm">فعال</span> @else <span class="input-group-text bg-danger text-white" wire:click.prevent.default="updateStatus({{$client->id}},true)" id="inputGroup-sizing-sm">مفصول</span> @endif
                 <br> <br>
                
                 <span class="input-group-text" id="inputGroup-sizing-sm"> {{$client->user->name}}</span> 

                 <span class="input-group-text" id="inputGroup-sizing-sm"> {{ $client->date}}</span> 
                 @endif 
                </div>

		<div class="input-group input-group-sm mb-3"> </div>
		@endforeach
	</div>
	@endif
	<script>
        function resetSearch(){
         

            document.getElementById("search").value = '';
            
        }
		function myFunction() {
		    var search = document.getElementById("search");
		    var address = document.getElementById("address");
		    if (search.style.display === "none") {
		        search.style.display = "block";
		        address.style.display = "none";
		    } else {
		        search.style.display = "none";
		        address.style.display = "block";
		    }
		}
		
		function example2() {
		    navigator.vibrate([100, 50, 100, 50]);
		}
	</script>
</div>