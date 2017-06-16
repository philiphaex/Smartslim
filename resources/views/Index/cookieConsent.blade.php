{{--
<div class="panel panel-default" id="cookieConsent">
    <div class="panel-body">
        <div class="container">
        Deze website maakt gebruik van cookies om de surfervaring te verbeteren. Door gebruik te maken van deze website staat u het gebruik van cookies toe.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    </div>
</div>
--}}
@if(Cookie::get('smartslim') != 'visited')
<div class="alert" id="cookieConsent">
        <div class="container">
            <div class="col-md-10">
                Wij gebruiken cookies om uw gebruikservaring op onze website te verbeteren.  Meer info vindt u in onze <a href="{{url('/privacy')}}">privacy policy</a>
            </div>
            <div class="col-md-offset-1">
                <button class="btn btn-default" class="close" aria-label="Close" data-dismiss="alert" id="accept-cookies">Ik ga akkoord</button>
            </div>
        </div>
</div>
    @endif
