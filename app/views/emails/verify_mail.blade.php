<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h1>@lang('login.verify_mail_subject')</h1>
    <br/>
    @lang('login.verify_content')
    <br/><br/>
    {{ URL::route("user.verify", compact("confirmation_code")) }}
    <br/><br/>
    @lang('login.confirm_not_working')
    <br/><br/>
    {{ URL::route("user.verify_index") }}
  </body>
</html>

