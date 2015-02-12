<ul class="list-group">
    @if(Auth::check())
    <li class="list-group-item"><a href="{{URL::route('user.logout')}}" >@lang('user.logout')</a></li>
    <li class="list-group-item"><a href="{{URL::route('comic.add')}}" >@lang('comic.addLink')</a></li>
    @else
    <li class="list-group-item"><a href="{{URL::route('user.signin')}}" >@lang('user.signIn')</a></li>
    @endif
    <li class="list-group-item"><a href="{{URL::route('comics.list')}}" >@lang('comics.listLink')</a></li>
    <li class="list-group-item"><a href="{{URL::route('strip.create', ['comic_id' => 1])}}" >@lang('strip.importLink')</a></li>
    <li class="list-group-item">
        <span class="badge">{{ $pendingStrips }}</span>
        <a href="{{URL::route('strip.index', ['comic_id' => 1])}}" >@lang('strips.pending')</a>
    </li>
    <li class="list-group-item"><a href="{{URL::route('strip.clean', ['comic_id' => 1, 'id' => 3])}}" >@lang('strip.cleanLink')</a></li>
    <li class="list-group-item"><a href="{{URL::route('strip.translate', ['comic_id' => 1, 'id' => 3])}}" >@lang('strip.translateLink')</a></li>
</ul>

