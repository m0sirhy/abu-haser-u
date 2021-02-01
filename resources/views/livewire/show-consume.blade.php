<div class="box box-primary">

    <div class="box-header with-border">


        <h3 class="box-title" style="margin-bottom: 15px">@lang('site.clients') <small>@if  (auth()->user()->hasRole('super_admin')) {{$total}}  اجمالي الاستهلاك : @endif</small></h3>


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
        <div class="row">

            <div class="col-md-4">
                <input type="text" name="search" wire:model="query" class="form-control" placeholder="بحث" value="">
            </div>

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> بحث</button>
                <button class="btn btn-primary  print-btn"><i class="fa fa-plus"></i> طباعة</button>
            </div>

        </div>
    </div><!-- end of box header -->

    <div class="box-body">

        @if (true)

        <table class="table table-bordered table-hover" id="print-area">


            <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('site.name')</th>

                    <th>القراءة السابقة</th>
                    <th>القراءة الحالية</th>
                    <th>الاستهلاك</th>
                    <th>الحالة</th>
                    <th> ادخال /تعديل </th>
                    <th>@lang('site.address')</th>
                    <th>@lang('site.mobile')</th>
                    @if (auth()->user()->hasRole('super_admin'))

                    <th>@lang('site.updated_by')</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach ($clients as $index=>$client)
                <form wire:submit.prevent="update({{$client->id}})" >

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $client->full_name }}</td>
                        <td>{{$client->previous }}</td>

                        <td>{{ $client->fcurent }}</td>

                        <td> {{ $client->consume}}</td>
                        <td>
                            @if($client->label)
                            <button type="button" class="btn btn-primary" wire:click.prevent.default="updateStatus({{$client->id}},false)">فعال</button>

                            @else
                            <button type="button" class="btn btn-danger" wire:click.prevent.default="updateStatus({{$client->id}},true)">مفصول</button>

                            @endif
                        </td>
                        <td>
                            <input type="number" autocomplete="off" wire:model.defer="curent" class="form-control no-border">

                        </td>

                        <td>{{ $client->address }}</td>
                        <td>{{ $client->mobile }} </td>
                        @if (auth()->user()->hasRole('super_admin'))

                        <td>{{ $client->user->name }} </td>
                        @endif
                    </tr>
                </form>
                @endforeach
            </tbody>

        </table><!-- end of table -->


        @else

        <h2>@lang('site.no_data_found')</h2>

        @endif

    </div><!-- end of box body -->


</div><!-- end of box -->
