@extends('layouts.master') 
@section('master.scripts')
{{HTML::script('packages/boostrap-table/js/jquery.dataTables.min.js')}}
{{HTML::script('packages/jquery-ui/js/jquery-ui-1.9.2.custom.min.js')}}
<script type="text/javascript">
$(document).ready(function() {
	var clicked = 0;
    $('#tableData').dataTable( {
        "order": [[ 0, "asc" ]]
    } );
        
    $(".btn-danger").on('click', function(e){
        var $id = $(this).attr('id')
        $('input#inputB').val($id);
    });
    $('#autocomplete').autocomplete({
    	 source : function(requete, reponse){ // les deux arguments représentent les données nécessaires au plugin
    		    $.ajax({
    		            url : '/ws/getUsers', // on appelle le script JSON
    		            dataType : 'json', // on spécifie bien que le type de données est en JSON
    		            data : {
    		                name_startsWith : $('#autocomplete').val() // on donne la chaîne de caractère tapée dans le champ de recherche
    		            },
    		            success : function(donnee){          
    		            	reponse($.map(donnee.username, function(objet){
    		                    return objet.username; // on retourne cette forme de suggestion
    		                }));
    		            }
    		        });
    		    }
    });

    $('#submit').on('click', function(e){
        $form = "#form" + $('input#inputB').val();
        $($form).submit();
    });
    
} );
</script>
@stop 
@section('master.content')
@if(Session::has('message'))
<p class="alert alert-info alert-dismissible">{{ Session::get('message') }}</p>
@endif

<div class="row">
    <div class="col-xs-10 col-xs-height">
	   <h3>Comic {{ $comic->title}}</h3>		
    </div>
	</br>
</div>
<div class="row">
	<div class="well">
		<div class="table-responsive">
			<table id="tableData" class="display table table-hover" width="100%">
				<thead>
					<tr>
						<th>Role</th>
						<th>@lang('login.login')</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($rolesR as $roleR)	
					<tr>
						<td>{{Role::find($roleR->role_id)->name}}</td>
						<td>{{User::find($roleR->user_id)->username}}</td>
					    <td class="text-center"> 
					    {{ Form::open(['route' => ['comic.role.destroy', $comic->id , $roleR->id], 'method' => 'delete', 'id' =>'form'.$roleR->id ]); }}  
						<a title=lang('base.delete') data-toggle="modal" data-target="#confirm-submit" data-href={{$roleR->id}} class='btn btn-danger btn-sm glyphicon glyphicon-remove' id={{$roleR->id}}></a>
						{{ Form::close();}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<br/>
<div class="row">
    <div class="well bs-component">
        <div class="text-center center-block">
        {{ Form::open(['route' => ['comic.role.create', $comic->id], 'method' => 'POST','role'=> 'form', 'class' => 'form-inline','id' =>'createRole' ])}}
        {{ Form::text('name', null, array('class'=>'form-control pull-left', 'id' => 'autocomplete', 'placeholder'=> Lang::get('login.login'))) }}
        {{ Form::select('role',$role ,null, ['class' => 'form-control', 'id' => 'role'])}}
        {{ Form::submit(Lang::get('role.submit'), array('class'=>'btn btn-primary pull-right'))}}
        {{Form::close()}}
        </div>
     </div>
</div>
@include('common.submit_delete')
@stop