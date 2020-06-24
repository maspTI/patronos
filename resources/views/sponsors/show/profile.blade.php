<div class="card card-profile">
    @if($sponsor->avatar)
    <div class="card-avatar">
        <a href="javascript:void(0);">
            <img class="img" src="{{ $sponsor->avatar }}"/>
        </a>
    </div>
    @endif
    <div class="card-body">
        <h4 class="card-title">{{ Str::title($sponsor->nome_fantasia) }}</h4>
        <h6 class="card-category text-gray">{{ $sponsor->occupation_area }}</h6>
        <h6 class="card-category text-gray d-flex flex-wrap justify-content-center align-items-center">
            <span class="mx-1">{{ $sponsor->category->name }}</span>
        </h6>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 d-flex justify-content-center align-items-center flex-wrap">
                    @foreach($sponsor->social_medias as $social_media)
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
