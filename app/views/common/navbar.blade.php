<div class="sponsor">
<ul class="list-group">
    @if(Auth::check())
    <li class="list-group-item"><a href="{{URL::route('user.logout')}}" >@lang('user.logout')</a><small> &nbsp;&nbsp; ({{ Auth::user()->username }})</small></li>
    <li class="list-group-item"><a href="{{URL::route('comic.create')}}" >@lang('comic.addLink')</a></li>
    @else
    <li class="list-group-item"><a href="{{URL::route('user.signin')}}" >@lang('user.signIn')</a></li>
    <li class="list-group-item"><a href="{{URL::route('user.signup')}}" >@lang('login.sign_up_here')</a></li>
    @endif
    <li class="list-group-item"><a href="{{URL::route('comic.index')}}" >@lang('comic.listLink')</a></li>
    @if(Auth::check())
        @if (Auth::user()->isSuperAdministrator(Auth::id()))
        <li class="list-group-item"><a href="{{URL::route('private..roles.index')}}" >@lang('master.role')</a></li>
        @endif
    @endif
</ul>
<ul class="list-group" >
     <li class="list-group-item"><a href="" >@lang('social.shareSite1') @lang('social.shareSite2') !</a></li>
    <li class="list-group-item text-center center-block custom-comic-social-button-group">
        <a class='custom-facebook-button' href="http://www.facebook.com/share.php?u={{URL::to('/')}}" onclick="return !window.open(this.href, 'Facebook', 'width=500,height=500')"
    target="_blank">
            <i class="fa fa-facebook"></i></a>
        <a class='custom-twitter-button' href="http://twitter.com/share?url={{URL::to('/')}}"  onclick="return !window.open(this.href, 'Twitter', 'width=500,height=500')"
    target="_blank">
            <i class="fa fa-twitter"></i>
        </a>
        <a class='custom-google-plus-button' href="https://plus.google.com/share?url={{URL::to('/')}}" onclick="return !window.open(this.href, 'Google', 'width=500,height=500')"
    target="_blank">
            <i class="fa fa-google-plus"></i>
        </a>
    </li>
</ul>

</div>

