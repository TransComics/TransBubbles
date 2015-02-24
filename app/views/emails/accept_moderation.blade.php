<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h1>@lang('moderate.accepted_comic')</h1>
    <br/>
    {{ Lang::get('moderate.accepted_comic_content', ['username' => $username]) }}
    <br/> <br/>
    {{ URL::route('home') }}
    <br/><br/>
  </body>
</html>