 @if(Auth::check() && Auth::user()->isComicModerator($comic->id))
    <div class="list-group">
        <h4 class="list-group-item"> @lang('moderate.navTitle') </h4>
        @if($nb_pending)
        <a class="list-group-item" href="{{URL::route('strip.moderate', [$comic->id, $strip_id])}}" >@lang('strip.pendingStrip')<span class="badge">{{ $nb_pending }}</span></a>
        @else
        <a class="list-group-item disabled" style="background-color:#303030 ;" href="" >@lang('strip.pendingStrip')<span class="badge">{{ $nb_pending }}</span></a>
        @endif
        @if($nb_pending_shape)
        <a class="list-group-item" href="{{URL::route('strip.moderateShape', [$comic->id, $shape_id])}}" >@lang('strip.pendingShape')<span class="badge">{{ $nb_pending_shape }}</span></a>
        @else
        <a class="list-group-item disabled" style="background-color:#303030 ;" href="" >@lang('strip.pendingShape')<span class="badge">{{ $nb_pending_shape }}</span></a>
        @endif
        @if($nb_pending_import)
        <a class="list-group-item" href="{{URL::route('strip.moderateImport', [$comic->id, $import_id])}}" >@lang('strip.pendingImport')<span class="badge">{{ $nb_pending_import }}</span></a>
        @else
        <a class="list-group-item disabled" style="background-color:#303030 ;" href="" >@lang('strip.pendingImport')<span class="badge">{{ $nb_pending_import }}</span></a>
        @endif
        @if($nb_pending_bubble)
        <a class="list-group-item" href="{{URL::route('strip.moderateBubble', [$comic->id, $bubble_id])}}" >@lang('strip.pendingBubble')<span class="badge">{{ $nb_pending_bubble }}</span></a>
        @else
        <a class="list-group-item disabled" style="background-color:#303030 ;" href="" >@lang('strip.pendingBubble')<span class="badge">{{ $nb_pending_bubble }}</span></a>
        @endif
     </div>
@endif
