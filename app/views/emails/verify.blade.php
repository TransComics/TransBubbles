<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h1>@lang('login.verify_mail_subject')</h1>
    @lang('login.verify_content')
    {{ URL::route("user.verify", compact("confirmation_code")) }}
  </body>
</html>

