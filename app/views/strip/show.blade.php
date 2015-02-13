@extends('layouts.master')


@section('master.content')
 
<div>
<h1>{{ $strips->title }}</h1>
<br>
Créé le {{ $strips->created_at }}
<br>
Mis à jour le {{ $strips->updated_at   }}
</div>


<div id="main">
    {{ HTML::image($strips->path, 'strip', array('id' => 'i')) }}
</div>


<div class="btn-group" role="group">
    <a class='btn btn-primary glyphicon glyphicon glyphicon-heart' href=""></a>
    <a class='btn btn-primary glyphicon glyphicon glyphicon-thumbs-up' href=""></a>
    <a class='btn btn-primary glyphicon glyphicon glyphicon-thumbs-down' href=""></a>
</div>

<div class="btn-group" role="group">
    <a class='btn btn-primary glyphicon glyphicon-fast-backward' href=""></a>
     <a class='btn btn-primary glyphicon glyphicon-chevron-left' href=""></a>
    <a class='btn btn-primary glyphicon glyphicon-random' href="{{URL::route('strip.show', array('comic_id'=>$strips->comic_id,'id'=>$strips->id))}}" id="btnRandom"></a>
     <a class='btn btn-primary glyphicon glyphicon-chevron-right' href=""></a>
    <a class='btn btn-primary glyphicon glyphicon-fast-forward' href=""></a>
</div>

@stop