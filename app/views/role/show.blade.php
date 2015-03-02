@extends('layouts.master') @section('master.scripts')
{{HTML::script('packages/boostrap-table/js/jquery.dataTables.min.js')}}
{{HTML::script('packages/jquery-ui/js/jquery-ui-1.9.2.custom.min.js')}}
<script type="text/javascript">
    $(document).ready(function () {
        $('#tableData').dataTable({
            "order": [[0, "asc"]]
        });


        $('#submit').on('click', function (e) {
            $form = "#form" + $('input#inputB').val();
            $($form).submit();
        });

        $(".btn-danger").on('click', function (e) {
            var $id = $(this).attr('id')
            $('input#inputB').val($id);
        });

        $('#autocomplete').autocomplete({
            source: function (requete, reponse) { // les deux arguments représentent les données nécessaires au plugin
                $.ajax({
                    url: '/ws/getUsers', // on appelle le script JSON
                    dataType: 'json', // on spécifie bien que le type de données est en JSON
                    data: {
                        name_startsWith: $('#autocomplete').val() // on donne la chaîne de caractère tapée dans le champ de recherche
                    },
                    success: function (donnee) {
                        reponse($.map(donnee.username, function (objet) {
                            return objet.username; // on retourne cette forme de suggestion
                        }));
                    }
                });
            }
        });
    });
</script>
@stop @section('master.content') @if(Session::has('message'))
<p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

@if(Session::has('error'))
<p class="alert alert-danger">{{ Session::get('error') }}</p>
@endif

<div class="row">
    <div class="row-same-height">
        <div class="col-xs-10 col-xs-height">
            <h3>Role {{$role->name}}</h3>
        </div>
        <div class="col-xs-1 col-xs-height col-bottom">
            {{ HTML::linkRoute('private..roles.edit', Lang::get('role.edit'), array($role->id), array('class' => 'btn btn-primary')) }}
        </div>
        <div class="col-xs-1 col-xs-height col-bottom">
            {{ HTML::linkRoute('private..roles.destroy',Lang::get('role.delete'), array($role->id), array('class' => 'btn btn-danger')) }}
        </div>
    </div>
</div>
<br />
<div class="row">
    <div class="well">
        <div class="table-responsive">
            <table id="tableData" class="display table table-hover" width="100%">
                <thead>
                    <tr>
                        <th>@lang('login.login')</th>
                        <th>@lang('role.ressource')</th>
                        <th>@lang('role.ressource_id')</th>
                        <th>@lang('base.delete')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($role_ressources as $role_r)
                    <tr>
                        <td>{{ User::find($role_r->user_id)->username }}</td>
                        @if($role_r->ressource == 1)
                        <td>@lang('role.comic')</td>
                        @elseif($role_r->ressource == 2)
                        <td>@lang('role.strip')</td>
                        @else
                        <td>@lang('role.all')</td> 
                        @endif 
                        @if($role_r->ressource_id)
                        <td>{{$role_r->ressource_id}}</td> 
                        @else
                        <td>@lang('role.all')</td> 
                        @endif
                        <td class="text-center"> 
                            {{ Form::open(['route' => ['roles.user.destroy', $role->id, $role_r->id], 'method' => 'delete', 'id' =>'form'.$role_r->id ]); }}  
                            <a title=lang('base.delete') data-toggle="modal" data-target="#confirm-submit" data-href={{$role_r->id}} class='btn btn-danger btn-sm glyphicon glyphicon-remove' id={{$role_r->id}}></a>
                            {{ Form::close();}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="well bs-component" style="overflow: hidden;">
        <div class="text-center center-block">
            {{ Form::open(['route' => ['roles.storeUserRole', $role->id], 'method' => 'POST','role'=> 'form', 'class' => 'form-inline','id' =>'createRole' ])}}
            {{ Form::text('name', null, array('class'=>'form-control pull-left', 'id' => 'autocomplete', 'placeholder'=> Lang::get('login.login'))) }}
            {{ Form::submit(Lang::get('role.submit'), array('class'=>'btn btn-primary pull-right'))}}
            {{Form::close()}}
        </div>
    </div>
</div>
@include('common.submit_delete')
@stop
