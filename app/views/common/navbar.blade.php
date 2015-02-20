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
</div>

