<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="color-scheme: light dark; supported-color-schemes: light dark;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title></title>
    <style type="text/css" rel="stylesheet" media="all">
@media only screen and (max-width: 500px) {
  .button {
    width: 100% !important;
    text-align: center !important;
  }
}
@media only screen and (max-width: 600px) {
  .email-body_inner,
.email-footer {
    width: 100% !important;
  }
}
@media (prefers-color-scheme: dark) {
  body,
.email-body,
.email-body_inner,
.email-content,
.email-wrapper,
.email-masthead,
.email-footer {
    background-color: #333333 !important;
    color: #FFF !important;
  }

  p,
ul,
ol,
blockquote,
h1,
h2,
h3,
span,
.purchase_item {
    color: #FFF !important;
  }

  .attributes_content,
.discount {
    background-color: #222 !important;
  }

  .email-masthead_name {
    text-shadow: none !important;
  }
}
</style>
    <!--[if mso]>
    <style type="text/css">
      .f-fallback  {
        font-family: Arial, sans-serif;
      }
    </style>
  <![endif]-->
  </head>
  <body dir="rtl" style="height: 100%; margin: 0; -webkit-text-size-adjust: none; font-family: 'Tajawal', Helvetica, Arial, sans-serif; background-color: #F2F4F6; color: #51545E; width: 100%;">
    <span class="preheader" style="visibility: hidden; mso-hide: all; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; display: none;">الكتاب [{{ $book_name }}] تأخر موعد إرجاعه. رجاء قم بإرجاع الكتاب في أسرع وقت.</span>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #F2F4F6;" bgcolor="#F2F4F6">
      <tr>
        <td align="center" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px;">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
            <tr>
              <td class="email-masthead" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px; padding: 25px 0; text-align: center;" align="center">
                <a href="{{ route('home') }}" class="f-fallback email-masthead_name" style="font-size: 16px; font-weight: bold; color: #A8AAAF; text-decoration: none; text-shadow: 0 1px 0 white;">
                  {{ Setting::get("app_name") }}
              </a>
              </td>
            </tr>
            <!-- Email Body -->
            <tr>
              <td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0;">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #FFFFFF;" bgcolor="#FFFFFF">
                  <!-- Body content -->
                  <tr>
                    <td class="content-cell" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px; padding: 45px;">
                      <div class="f-fallback">
                        <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: right;">مدة استعارة الكتاب "{{$book_name}}" قد انتهت</h1>
                        <p style="margin: .4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #51545E;">رجاء قم بارجاع الكتاب "{{$book_name}}" في أقرب وقت إلى {{ Setting::get("app_name") }}، وإلا ستضطر لدفع غرامة تأخير.</p>
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px;">
                <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center;">
                  <tr>
                    <td class="content-cell" align="center" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px; padding: 45px;">
                      <p class="f-fallback sub align-center" style="margin: .4em 0 1.1875em; line-height: 1.625; text-align: center; font-size: 13px; color: #A8AAAF;">&copy; <?php echo date("Y"); ?> {{ Setting::get("app_name") }}. جميع الحقوق محفوظة.</p>
                      <p class="f-fallback sub align-center" style="margin: .4em 0 1.1875em; line-height: 1.625; text-align: center; font-size: 13px; color: #A8AAAF;">
                        {{ Setting::get("app_name") }}
                        <br>{{ Setting::get("address") }}
                      </p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
