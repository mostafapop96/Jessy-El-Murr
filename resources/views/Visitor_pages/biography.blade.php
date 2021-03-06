@extends('Visitor_pages.master')
@section('content')
    <div class="row" style="    background-image: linear-gradient(96deg, rgba(74, 98, 220, 0.99) 7%, rgba(97, 44, 214, 0.99) 100%);
    background-size: 100% 100%;
    position: relative;
    overflow: hidden;">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="row">

                <div class="col-lg-6" style="overflow: hidden;">
                    {{--text--}}
                    <p style="display: block;font-size: 2.7rem;font-weight: 900;padding: 25px 0 0 0;background: linear-gradient(162deg, #f0f0f0, #96d6ee);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">Jessy El Murr</p>
                    @foreach($phrases as $phrase)
                        <p class="phrases-secondpart" style="padding: 25px 0 0 0;color: white;font-size: 1.5rem;font-weight: 600;">{{$phrase}}</p>
                    @endforeach
                </div>
                <div class="col-lg-1">

                </div>
                <div class="col-lg-5">
                    {{--photos--}}
                    <img class="img-fluid" style="border-radius: 19% 1%;padding-bottom: 30px;"  src="{{ asset('visitor/imgs/biography/bio.png') }}" alt="Card image cap">
                </div>

            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
@endsection
