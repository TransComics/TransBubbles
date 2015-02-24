<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h1>@lang('moderate.refused_comic')</h1>
    <br/>
    {{ Lang::get('moderate.refused_comic_content', ['username' => $username]) }}
    <br/>
    {{ Lang::get('moderate.refused_comment', ['comment' => $comment] ) }}
    <br/> <br/>
    @if($deleted)
    @lang('moderate.deleted_comic_content')
    @else
    @lang('moderate.undeleted_comic_content')
    @endif
    <br/><br/>
  </body>
</html>
