<div class="sponsor">
<ul class="list-group">
    @if(Auth::check())
    <li class="list-group-item"><a href="{{URL::route('user.logout')}}" >@lang('user.logout')</a></li>
    <li class="list-group-item"><a href="{{URL::route('comic.create')}}" >@lang('comic.addLink')</a></li>
    @else
    <li class="list-group-item"><a href="{{URL::route('user.signin')}}" >@lang('user.signIn')</a></li>
    <li class="list-group-item"><a href="{{URL::route('user.signup')}}" >@lang('login.sign_up_here')</a></li>
    @endif
    <li class="list-group-item"><a href="{{URL::route('comic.index')}}" >@lang('comic.listLink')</a></li>
    @if(Auth::check())
    <li class="list-group-item">
        <span class="badge">{{ $pendingStrips }}</span>
        <a href="{{URL::route('strip.index', ['comic_id' => 1])}}" >@lang('strip.pending')</a>
    </li>
    @endif
</ul>
    
<ul class="list-group">
    <li class="list-group-item"><a href="" >@lang('social.shareSite1') @lang('social.shareSite2') !</a></li>
    <li class="list-group-item"><a href="" >{{ Shareable::facebook(array('url' => URL::route('home'))) }} <a/></li>
    <li class="list-group-item"><a href="" >{{ Shareable::twitter(array('url' => URL::route('home'))) }}<a/></li>
    <li class="list-group-item"><a href="" >{{ Shareable::googlePlus(array('url' => URL::route('home'))) }}<a/></li>
</ul>
</div>

