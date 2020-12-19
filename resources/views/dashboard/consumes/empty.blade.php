@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.clients')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li class="active">@lang('site.clients')</li>
        </ol>
    </section>

    <section class="content">
    <livewire:empty-consume />

    </section><!-- end of content -->

</div><!-- end of content wrapper -->


@endsection