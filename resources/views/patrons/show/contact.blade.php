<div class="row">
    <div class="col-md-6">
        <div class="container-fluid">
            <div class="row border">
                <div class="col-md-12">
                    <h4>Email(s)</h4>
                </div>
                <div class="col-md-12 d-flex justify-content-center align-items-center flex-wrap">
                    @foreach($patron->emails as $email)
                    <span class="text-capitalize mx-2">
                        {{ $email['name'] }}:&nbsp;
                        <a href="mailto:{{ $email['content'] }}" class="text-lowercase text-muted">{{ $email['content'] }}</a>
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="container-fluid">
            <div class="row border">
                <div class="col-md-12">
                    <h4>Telefone(s)</h4>
                </div>
                <div class="col-md-12 d-flex justify-content-around align-items-center flex-wrap">
                    @foreach($patron->phones as $phone)
                    <span class="text-capitalize d-flex align-items-center mx-2">
                        {{ $phone['name'] }}:&nbsp;
                        <img class="flag" src="{{ $phone['country']['flag'] }}" alt="{{ $phone['country']['name'] }}"/>
                        <a href="tel:{{ $phone['phone'] }}" class="text-lowercase text-muted">{{ $phone['phone'] }}</a>
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
