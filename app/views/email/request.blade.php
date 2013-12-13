<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>
                <p>
                You requested to reset your password. Please follow the link to do so:
                <br />
                {{ URL::to('password/reset', array($token)) }}
                </p>
	</body>
</html>
