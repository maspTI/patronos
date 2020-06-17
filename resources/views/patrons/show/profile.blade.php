<div class="card card-profile">
    @if($patron->avatar)
    <div class="card-avatar">
        <a href="javascript:void(0);">
            <img class="img" src="{{ $patron->avatar }}"/>
        </a>
    </div>
    @endif
    <div class="card-body">
        <h4 class="card-title">{{ $patron->name }}</h4>
        <h6 class="card-category text-gray">{{ $patron->occupation . ' / '.  $patron->company }}</h6>
        <h6 class="card-category text-gray">Aniversário: {{ $patron->birthday->format('d/m') }}</h6>
        <h6 class="card-category text-gray d-flex flex-wrap justify-content-center align-items-center">
            @foreach($patron->categories as $category)
            <span class="mx-1">{{ $category->name }}</span>
            @endforeach
        </h6>
        <p class="card-description text-uppercase">{{ $patron->bio }}</p>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 d-flex justify-content-center align-items-center flex-wrap">
                    @foreach($patron->social_medias as $social_media)
                    <a href="{{ $social_media['content'] }}" class="btn-social mx-2" target="_blank">
                        <i class="fab fa-{{ $social_media['name'] }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
