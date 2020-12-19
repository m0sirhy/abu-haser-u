@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.dashboard')</h1>

        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">
         
            {{--products--}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>0</h3>

                        <p>ادخال القراءات</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('consume')}}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
           
            @if (auth()->user()->hasPermission('read_clients'))

            {{--clients--}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>0</h3>

                        <p>@lang('site.clients')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="{{ route('dashboard.clients.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif
            @if (auth()->user()->hasPermission('read_users'))

            {{--users--}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $users_count }}</h3>

                        <p>@lang('site.users')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif
            @if (auth()->user()->hasPermission('read_outlays'))

            {{--outlays--}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>$</h3>

                        <p>@lang('site.outlays')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pie-chart"></i>
                    </div>
                    <a href="{{ route('dashboard.outlays.index') }}" class="small-box-footer">@lang('site.read') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            @endif

        </div><!-- end of row -->

        <div class="box box-solid">

            <div class="box-header">
                <h3 class="box-title">مؤشر المصروفات الشهرية :</h3>
            </div>
            <div class="box-body border-radius-none">
                <div class="chart" id="line-chart" style="height: 250px;"></div>
            </div>
            <!-- /.box-body -->
        </div>

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection

@push('scripts')

    <script>

        //line chart
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                @foreach ($sales_data as $data)
                {
                    ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
},
@endforeach
],
xkey: 'ym',
ykeys: ['sum'],
labels: ['@lang('site.total')'],
lineWidth: 2,
hideHover: 'auto',
gridStrokeWidth: 0.4,
pointSize: 4,
gridTextFamily: 'Open Sans',
gridTextSize: 10
});
</script>
@endpush