@extends('layouts.master')

@section('master.scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#submit').on('click', function (e) {
            $('#deleteForm').submit();
        });
    });
</script>
@stop 

@section('master.content')
<div class="page-header">
    <div class="row">
        <div class="row-same-height" style="border-bottom: 1px solid #464545;">
            <div class="col-md-9 col-xs-height">
                <h1>
                    {{$comic->title}}
                    <small>{{ Lang::get('comic.created',['created' => $comic->author]) }}</small>
                    @if (Auth::check() && Auth::user()->isComicAdminWithID($comic->id))
                    <a href="{{URL::route('comic.edit', [$comic->id])}}" title="@lang('base.edit')" class='btn btn-sm btn-primary glyphicon glyphicon-pencil'></a>
                    {{ Form::open(['route' => ['comic.destroy', $comic->id], 'method' => 'delete', 'id' => 'deleteForm', 'style' => 'display : inline;']); }}
                    <a title="@lang('base.delete')" data-toggle="modal" data-target="#confirm-submit" data-href="{{$comic->id}}" class="btn btn-danger btn-sm glyphicon glyphicon-remove"></a>
                    <a href="{{URL::route('comic.role', [$comic->id])}}" title="@lang('base.role')" class='btn btn-sm btn-default glyphicon glyphicon-lock'></a>
                    {{ Form::close(); }}
                    @endif
                </h1>
            </div>
            <div class="col-md-3 col-xs-height col-bottom"><p class="pull-right">{{Lang::get('comic.imported',['imported'
				=> User::find($comic->created_by)->username]) }}</p></div>
        </div>
    </div>
</div>
@if($comic->cover)
<div>{{ HTML::image($comic->cover, 'cover', array('width' => '846', 'height' => '170', 'class' => 'img-thumbnail')) }}</div>
</br>
@endif
<div class="well">
    <h4>{{ $comic->description }}</h4>
</div>
</br>

<div class="row">
    <div class="row-same-height">
        <div class="col-xs-10 col-xs-height">
            <h3>@if (count($strips) > 0) @lang('comic.lastStrip') @else @lang('comic.noStrip') @endif</h3>
        </div>
        <div class="col-xs-2  col-xs-height col-bottom">
            @if (count($strips) > 0)
            <a href="{{URL::route('strip.index', [$comic->id])}}" title="@lang('strip.index')" class='btn btn-sm btn-primary glyphicon glyphicon-th'></a>
            @endif
            @if (Auth::check())
            <a href="{{URL::route('strip.create', [$comic->id])}}" title="@lang('base.add')" class='btn btn-sm btn-primary glyphicon glyphicon-plus'></a>
            @endif
        </div>
    </div>
</div>
@if (count($strips) > 0)
<hr>
<br/>
<div class="row">
    @foreach($strips as $strip)
    <div class="col-sm-6 col-lg-4 padding-10">
        <div class="border thumbnail padding-10">
            <a href="{{ route('strip.show',[ $comic->id, $strip->id]) }}">
             <div class="caption">
                <h3 class="one-line">
                    {{ $strip->title }} 
                </h3>
             </div>
             <img src="{{ Image::path($strip->path, 'resizeCrop', 250, 350) }}"  
             alt="{{$strip->title}}" class="img-responsive img-rounded" style="overflow:hidden; width:250px;
             height:250px; display:block; margin:0 auto;"/>
            </a>
         </div>
    </div>   
    @endforeach
</div>
@endif
@include('common.submit_delete')
@stop
@section('master.nav')
    @parent
    @include('common.moderate_nav')
@append
