<p>&nbsp;</p>
<div class="wrapper" style="background-color: #f2f2f2;">
    <table id="emb-email-header-container" class="header"
        style="border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto;" align="center">
        <tbody>
            <tr>
                <td style="padding: 0; width: 600px;"><br />
                    <div class="header__logo emb-logo-margin-box"
                        style="font-size: 26px; line-height: 32px; color: #c3ced9; font-family: Roboto,Tahoma,sans-serif; margin: 6px 20px 20px 20px;">
                        <img src="{{ asset('asset/images/'.$set->logo) }}" alt="logo" height="80">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <br />
    <table class="layout layout--no-gutter"
        style="border-collapse: collapse; table-layout: fixed; margin-left: auto; margin-right: auto; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #ffffff;"
        align="center">
        <tbody>
            <tr>
                <td class="column"
                    style="padding: 0; text-align: left; vertical-align: top; color: #60666d; font-size: 14px; line-height: 21px; font-family: sans-serif; width: 600px;">
                    <br />
                    <div style="margin-left: 20px; margin-right: 20px;"><span style="font-size: large;">Hi
                            Support,<br /></span>
                        @if ($is_msg_html)
                            <p><strong>{!! $message_text !!}</strong></p>
                        @else
                            <p><strong>{{ $message_text }}</strong></p>
                        @endif
                    </div>
                    <div style="margin-left: 20px; margin-right: 20px; margin-bottom: 24px;"><br />
                        <p class="size-14"
                            style="margin-top: 0; margin-bottom: 0; font-size: 14px; line-height: 21px;">
                            Thanks,<br /><strong>{{ $name }}<br /><strong>Reply Here: <a href="mailto:{{ $from_email }}" style="text-decoration: none;">{{ $from_email }}</a></strong></p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
