@extends('layouts.master')

@section('master.scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#submit').on('click', function(e){
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
                    {{$comic->title}} <small>{{ Lang::get('comic.created',['created' => $comic->author]) }}</small>
                    @if (Auth::check())
                    <a href="{{URL::route('comic.edit', [$comic->id])}}" title="comics.edit" class='btn btn-sm btn-primary glyphicon glyphicon-pencil'></a>
                    {{ Form::open(['route' => ['comic.destroy', $comic->id], 'method' => 'delete', 'id' => 'deleteForm', 'style' => 'display : inline;']); }}
                    <a title=lang('base.delete') data-toggle="modal" data-target="#confirm-submit" data-href="{{$comic->id}}" class="btn btn-danger btn-sm glyphicon glyphicon-remove"></a>
                    @if ($comic->created_by == Auth::id() || Auth::user()->isSuperAdministrator(Auth::id()))
                    <a href="{{URL::route('comic.role', [$comic->id])}}" title="comics.role" class='btn btn-sm btn-default glyphicon glyphicon-lock'></a>
                    @endif
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
<div>{{ HTML::image($comic->cover, 'cover', array('width' => '846',
	'height' => '170', 'class' => 'img-thumbnail')) }}</div>
</br>
@endif
<div class="well">
    <h4>{{$comic->description}}</h4>
</div>
</br>

<div class="row">
    <div class="row-same-height">
        <div class="col-xs-10 col-xs-height">
            <h3>@lang('comic.lastStrip')</h3>
        </div>
        
        <div class="col-xs-2  col-xs-height col-bottom">
            <a href="{{URL::route('strip.index', [$comic->id])}}" title="strip.index" class='btn btn-sm btn-primary glyphicon glyphicon-th'></a>
            @if (Auth::check())
                <a href="{{URL::route('strip.create', [$comic->id])}}" title="strip.add" class='btn btn-sm btn-primary glyphicon glyphicon-plus'></a>
            @endif
        </div>
        
    </div>
</div>
<hr>
</br>
<div class="row">
    @foreach($strips as $strip)
    <div class="col-sm-6 col-md-4">
        <a href="{{ route('strip.show',[ $comic->id, $strip->id]) }}"
           class="thumbnail">
            <h4 class="caption">{{ $strip->title }}</h4>
            {{HTML::image($strip->path, $strip->title,['id' =>'imageThumb'])}}
        </a>

    </div>
    @endforeach

    @include('common.submit_delete')
</div>
@stop
