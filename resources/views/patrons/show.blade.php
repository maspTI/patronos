@extends('layouts.dashboard.index')

@section('title', '| ' . Str::title($patron->name))

@section('content')
<div class="container-flui">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary text-capitalize">
                    <h4 class="card-title">{{ $patron->name }}</h4>
                    <p class="card-category">{{ $patron->occupation }}</p>
                </div>
                <div class="card-body">
                    <div class="container-fluid">
                        @include('patrons.show.contact')
                        @include('patrons.show.addresses')

                        @if($patron->copatron)
                        @include('patrons.show.copatron')
                        @endif

                        @if(count($patron->dependents))
                        @include('patrons.show.dependents')
                        @endif

                        @include('patrons.show.secretaries')
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('patrons.show.profile')
        </div>
    </div>
</div>
@endsection

