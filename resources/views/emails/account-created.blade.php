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
    <span class="preheader" style="visibility: hidden; mso-hide: all; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; display: none;">مربحا بك في {{ Setting::get("app_name") }}</span>
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
                        <h1 style="margin-top: 0; color: #333333; font-size: 22px; font-weight: bold; text-align: right;">مرحبا، {{$name}}!</h1>
                        <p style="margin: .4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #51545E;">مرحبا بك في {{ Setting::get("app_name") }}، لقد تم إنشاء حسابك بنجاح، لتسجيل الدخول قم بالضغط على الزر التالي:</p>
                        <!-- Action -->
                        <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 30px auto; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center;">
                          <tr>
                            <td align="center" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px;">
                              <!-- Border based button
                              https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
                              <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                <tr>
                                  <td align="center" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px;">
                                    <a href="{{ route('login') }}" class="f-fallback button" target="_blank" style="background-color: #3869D4; border-top: 10px solid #3869D4; border-right: 18px solid #3869D4; border-bottom: 10px solid #3869D4; border-left: 18px solid #3869D4; display: inline-block; color: #FFF; text-decoration: none; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); -webkit-text-size-adjust: none; box-sizing: border-box;">تسجيل الدخول</a>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>
                        <p style="margin: .4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #51545E;">بيانات الحساب الخاص بك:</p>
                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="margin: 0 0 21px;">
                          <tr>
                            <td class="attributes_content" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px; background-color: #F4F4F7; padding: 16px;" bgcolor="#F4F4F7">
                              <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                <tr>
                                  <td class="attributes_item" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;">
                                    <span class="f-fallback">
                                      <strong>صفحة تسجيل الدخول:</strong> {{ route('login') }}
                                    </span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="attributes_item" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;">
                                    <span class="f-fallback">
                                      <strong>البريد الإلكتروني:</strong> {{$email}}
                                    </span>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="attributes_item" style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px; padding: 0;">
                                    <span class="f-fallback">
                                      <strong>كلمة المرور:</strong> {{$password}}
                                    </span>
                                  </td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                        </table>

                        <!-- Sub copy -->
                        <table class="body-sub" role="presentation" style="margin-top: 25px; padding-top: 25px; border-top: 1px solid #EAEAEC;">
                          <tr>
                            <td style="word-break: break-word; font-family: 'Tajawal', Helvetica, Arial, sans-serif; font-size: 16px;">
                              <p class="f-fallback sub" style="margin: .4em 0 1.1875em; line-height: 1.625; color: #51545E; font-size: 13px;">إذا واجهتك أي مشكلة في فتح الرابط بالزر أعلاه، قم بنسخ الرابط التالي في نافذة متصفح جديدة.</p>
                              <p class="f-fallback sub" style="margin: .4em 0 1.1875em; line-height: 1.625; color: #51545E; font-size: 13px;">{{ route('login') }}</p>
                            </td>
                          </tr>
                        </table>
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
