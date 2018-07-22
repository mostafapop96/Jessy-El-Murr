@extends('master')
@section('custom-style')
@endsection
@section('content')
    <div class="row" style="    background-image: linear-gradient(96deg, rgba(74, 98, 220, 0.99) 7%, rgba(97, 44, 214, 0.99) 100%);
    background-size: 100% 100%;
    position: relative;
    overflow: hidden;">
        <div class="col-lg-1"></div>
        <div class="col-lg-10">
            <div class="row">

                @foreach ($videos as $video)
                    <div class="col-lg-4">
                        <div class="card" style="background: none;border: none">
                            <img class="card-img-top"  src="{{ asset($video->photo) }}" alt="Card image cap">
                            <div class="card-body" style="padding: 1.25rem 0rem">
                                <a href={{$video->link}}><h1 class="card-title" style="font-size: 1.6rem;font-weight: bold;color: white">{{$video->title}}</h1></a>
                                <h4 class="card-title" style="font-size: 1.2rem;font-weight: bold;color: white">{{$video->duration}}</h4>
                            </div>
                            <div class="container-fluid" style="position: absolute;z-index: 1;left: 39%;top: 22%;left: calc(50% - 39px);
    margin-top: 18px;">
                                {{--Modal here--}}
                                <a href={{$video->link}}><img src="{{ asset('videoicon.png') }}" alt="Card image cap"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
    <div class="text-center">
    {{ $videos->links() }}
    </div>
@endsection
