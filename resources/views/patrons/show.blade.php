@extends('layouts.dashboard.index')

@section('title', '| ' . $patron->name)

@section('content')
<div class="container-flui">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ $patron->name }}</h4>
                    <p class="card-category">{{ $patron->occupation }}</p>
                </div>
                <div class="card-body">
                    <div class="col-md-12 d-flex justify-content-around align-items-center flex-wrap">
                        <span class="text-capitalize"></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                @if($patron->avatar)
                <div class="card-avatar">
                    <a href="javascript:;"
                    ><img class="img" src="{{ $patron->avatar }}"
                    /></a>
                </div>
                @endif
                <div class="card-body">
                    <h6 class="card-category text-gray" >{{ $patron->occupation . ' / '.  $patron->company }}</h6>
                    <h4 class="card-title">{{ $patron->name }}</h4>
                    <p class="card-description text-uppercase">{{ $patron->bio }}</p>
                    <div class="container-fluid">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6 d-flex justify-content-around align-items-center flex-wrap">
                                @foreach($patron->social_medias as $social_media)
                                <a href="{{ $social_media['content'] }}" class="btn-social" target="_blank">
                                    <i class="fab fa-{{ $social_media['name'] }}"></i>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
