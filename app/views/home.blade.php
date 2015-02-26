@extends('layouts.master')

@section('master.content')

<div class="row jumbotron">
    <h1>Transbubbles</h1>
    <p>Welcome to Transbubbles website !</p>

</div>

@if(Auth::check())
    {{ Session::get('message') }} 
    <p>{{ HTML::link('logout', 'logout') }}</p>
@endif 



<div class="row well">
    <div class="col-md-12">
        <h1>@lang('comic.lastStrip')</h1>

        <div class="well">
            <div id="myCarousel" class="carousel slide">
                
                <div class="carousel-inner">
                    @foreach($strips as $k => $item)
                    @if ($k % 3 == 0)
                    <div class="item @if($k == 0) active @endif">
                        <div class="row">
                    @endif
                            <div class="col-md-3 col-lg-4 padding-10">
                                <div class="thumbnail padding-10">
                                    <a href="{{ route('strip.show',[ $item->comic_id, $item->id]) }}" class="img-responsive">
                                        <div class="caption">
                                            <h3 class="one-line">
                                                {{ $item->comic->title }} 
                                            </h3>
                                        </div>
                                        <img src="{{ Image::path($item->path, 'resizeCrop', 250, 250)->responsive('max-width=400', 'resize', 100) }}"  alt="{{$item->title}}" 
                                             class="img-responsive img-rounded" style="overflow:hidden; width:250px;
                                             height:250px; display:block; margin:0 auto;"/>
                                    </a>
                                </div>
                            </div>
                    @if ($k % 3 == 2)
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row well">
    <div class="col-md-12">
        <h1>@lang('comic.latestUpdated')</h1>

        <div class="well">
            <div id="myCarousel2" class="carousel slide">
                
                <div class="carousel-inner">
                    @foreach($comics as $k => $item)
                    @if($item->cover)
                    <div class="item @if($k == 0) active @endif">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 col-xs-height">
                                        <a href="{{ route('strip.show', [$item->id]) }}">
                                            <h1>{{$item->title}}</h1>
                                        </a>
                                    </div>
                                </div>
                                <a href="{{ route('comic.show', [$item->id]) }}">
                               {{ HTML::image($item->cover, 'cover', array('width' => '846', 'height' => '170', 'class' => 'img-thumbnail')) }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <a class="left carousel-control" href="#myCarousel2" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel2" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>



@stop
