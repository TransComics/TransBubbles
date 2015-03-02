@if(Auth::check())
    @if (Auth::user()->isSuperAdministrator(Auth::id()))
    <div class="list-group">
        <h4 class="list-group-item"> @lang('base.navAdmin') </h4>
        <a class="list-group-item" href="{{URL::route('private..roles.index')}}" >@lang('base.role')</a>
        @if($nb_pending_comics)
        <a class="list-group-item" href="{{URL::route('comic.moderate')}}" >@lang('comic.pending')<span class="badge">{{ $nb_pending_comics }}</span></a>
        @else
        <a class="list-group-item disabled" style="background-color:#303030 ;" href="" >@lang('comic.pending')<span class="badge">{{ $nb_pending_comics }}</span></a>
        @endif 
    </div>
    @endif
@endif