@extends('layouts.html')

@section('html.styles')
{{HTML::style('packages/boostrap-table/css/jquery.dataTables.min.css')}} 
{{ HTML::style('packages/jquery-ui/css/custom-theme/jquery-ui-1.9.2.custom.css')}}
{{ HTML::style('packages/bootstrap-3.3.2-dist/css/bootstrap.min.css') }}
{{ HTML::style('packages/font-awesome-4.3.0/css/font-awesome.min.css') }}
<!-- Custom styles for this template -->
{{ HTML::style('css/offcanvas2.css') }}
 @yield('master.styles')
@stop

@section('html.scripts')
{{ HTML::script('js/lib/jquery-2.1.3.min.js') }}
{{ HTML::script('js/lib/jquery.imageready.js') }}
{{ HTML::script('packages/bllim/laravel-to-jquery-validation/jquery.validate.min.js') }}
{{ HTML::script('packages/bllim/laravel-to-jquery-validation/jquery.validate.laravel.js') }}
{{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap.min.js') }}
{{ HTML::script('packages/bootstrap-3.3.2-dist/js/bootstrap-filestyle.min.js') }}
{{ HTML::script('js/lib/fabric.js') }}
{{ HTML::script('js/showCanvas.js') }} 
{{ HTML::script('js/form-validation.js') }} 
{{ Image::js() }}
@yield('master.scripts')
@stop

@section('html.content')
@include('common.navbar_top')

<div class="container">
<div class="page-header" id="banner"></div>
    <div class="row">
        <div class="col-lg-9 col-md-10 col-sm-6">
            @yield('master.content')
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-lg-3 col-md-2 col-sm-6" id="sidebar">
            @section('master.nav')
                @include('common.navbar')
            @show
        </div><!--/.sidebar-offcanvas-->
    </div><!--/row-->
</div><!--/.container-->
@include('common.footer')
@stop
