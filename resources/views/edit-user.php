<!doctype html>
<html>
	<head>
		<title>KDI Photo - Edit User</title>
		<link rel="stylesheet" href="/assets/admin.css">
		<link rel="stylesheet" href="/assets/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	</head>
	<body class="ui-mobile-viewport ui-overlay-a">
		<div class="main-wrapper ui-content">
			<header>
			<img alt="KDI Photo" src="http://www.kdiphoto.com/wp-content/uploads/2013/07/kdi-logo.png">
			</header>
			<div class="container ui-body ui-body-a ui-corner-all">
				<h1>Edit User: <?php print $user->username; ?></h1>
				<form action="/admin/users/edit/<?php print $user->id; ?>" method="POST">
					<div class="ui-field-contain">
						<label for="email">Email:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="email" id="email" value="<?php print $user->email; ?>">
						</div>
					</div>
					<div class="ui-field-contain">
						<label for="password">Password:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="password" name="password" id="password">
						</div>
					</div>
					<div class="ui-field-contain">
						<div class="ui-btn ui-input-btn ui-corner-all ui-shadow">
							Save
							<input type="submit" value="Save">
						</div>
					</div>
					<a href="/admin/users">Cancel</a>
				</form>
			</div>
		</div>
	</body>
</html>