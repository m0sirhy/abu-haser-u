<!-- // this page intend to sort the outlays by date and category -->
@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.outlays')

        </h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.outlays')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.outlays') <small></small></h3>

                <form action="{{ route('dashboard.outlays.index') }}" method="get">
                    <div class="row">


                        <div class="col-md-4">

                            <select name="date" class="form-control">
                                <option value="">@lang('site.year')</option>
                                @foreach ($dates as $date)
                                <option value="{{ $date->year }}">{{ $date->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="month" class="form-control">
                                <option value="">@lang('site.month')</option>
                                @foreach ($dates as $date)
                                <option value=" {{$date->month}}">{{ $date->month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="month" class="form-control">
                                <option value="">@lang('site.category')</option>
                                @foreach ($dates as $date)
                                <option value=" {{$date->month}}">{{ $date->month }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                            @if (auth()->user()->hasPermission('create_categories'))
                            <a href="{{ route('dashboard.outlays.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            @endif
                        </div>

                    </div>

                </form><!-- end of form -->

            </div><!-- end of box header -->

            <div class="box-body">



                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>

                        </tr>
                    </thead>

                    <tbody>

                    </tbody>

                </table><!-- end of table -->



                <h2>@lang('site.no_data_found')</h2>


            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection