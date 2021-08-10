<title></title>
<div style="background: #FBFCFF; margin: 0;color: #424242;">
<table cellpadding="25" style="max-width:540px;margin:50px auto 0;font-family:-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;background:#fff;border-radius:15px 15px 0 0;box-shadow:0 0 20px rgba(0,0,0,0.1);padding:30px 0;">
	<tbody>
	   <!-- <tr>
			<td style="text-align:center;padding:20px 0 0;">
			<img src="{{--$logopath --}}" style="width:150px;margin:0 auto 50px;" /></td>
		</tr>  -->
		<tr>
			<td style="padding-left:50px;padding-right:50px;">
			<p style="font-size:18px;font-weight:bold;margin-top:0;">Hello {{ $name }},</p>
			<h1 style="font-weight:normal;">Reset Password Link</h1>
			<p style="line-height:24px;color:#8C8C8C;">Please click bellow this link to reset your password:</p>
			<p>
				<a href="{{ $url }}" style="color:#fff;text-decoration:none;background:#5676FF;padding:20px 60px;display:inline-block;border-radius: 6px;font-size: 16px;text-transform:uppercase;letter-spacing:1px;text-shadow:1px 1px 0px rgba(0,0,0,0.15);margin-top:10px;box-shadow:2px 3px 10px rgba(86, 118, 255, 0.4);" target="_blank">Verify Email</a></p>
			
			</td>
		</tr>
	</tbody>
</table>
</div>