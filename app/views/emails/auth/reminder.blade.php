<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			Để đặt lại mật khẩu mời bạn truy cập vào địa chỉ : {{ URL::to('reset-password', array($token)) }}.<br/>
			Liên kết này sẽ hết hiệu lực trong vòng{{ Config::get('auth.reminder.expire', 10) }} phút.
		</div>
	</body>
</html>
