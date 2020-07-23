@extends('layouts.dashboard.index')

@section('title', '| ' . Str::title($sponsor->nome_fantasia))

@section('content')
<div class="container-flui">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary text-capitalize">
                    <h4 class="card-title">{{ $sponsor->nome_fantasia }}</h4>
                    <p class="card-category">{{ $sponsor->occupation_area }}</p>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        @include('sponsors.show.addresses')

                        @include('sponsors.show.proxy')

                        @include('sponsors.show.contact')

                        @if(count($sponsor->payments))
                        @include('sponsors.show.payments')
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('sponsors.show.profile')
        </div>
    </div>
</div>
@endsection

