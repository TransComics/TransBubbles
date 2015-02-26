<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{URL::route('home')}}" >Trans<span class="themeColor">Bubbles<span></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @if(Route::currentRouteName() == "home")class="active" @endif><a href="{{URL::route('home')}}" >@lang('base.home')</a></li>
                <li @if(Route::currentRouteName() == "about")class="active" @endif><a href="#about" >@lang('base.about')</a></li>
                <li @if(Route::currentRouteName() == "contact")class="active" @endif><a href="#contact" >@lang('base.contactus')</a></li>
            </ul>
             @include('common.lang_selector')
        </div><!-- /.nav-collapse -->
           
    </div><!-- /.container -->
</div><!-- /.navbar -->
