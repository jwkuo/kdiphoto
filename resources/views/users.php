<!doctype html>
<html>
	<head>
		<title>KDI Photo - Manage Users</title>
		<link rel="stylesheet" href="/assets/admin.css">
		<link rel="stylesheet" href="/assets/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	</head>
	<body class="ui-mobile-viewport ui-overlay-a">
		<div class="main-wrapper ui-content">
			<header>
			<img alt="KDI Photo" src="http://www.kdiphoto.com/wp-content/uploads/2013/07/kdi-logo.png">
			</header>
			<div class="container ui-body ui-body-a ui-corner-all">
				<h1>Manage Users</h1>
				<?php if (!is_null($delete)){ if($delete == -1){?>
				<div class="ui-bar ui-bar-a ui-corner-all"><span>Cannot delete admin.</span></div>
				<?php }if($delete == 0){?>
				<div class="ui-bar ui-bar-a ui-corner-all"><span>Cannot delete yourself.</span></div>
				<?php }if($delete == 1){?>
				<div class="ui-bar ui-bar-a ui-corner-all"><span>User deleted.</span></div>
				<?php }}if(!is_null($update) && $update){?>
				<div class="ui-bar ui-bar-a ui-corner-all"><span>Updated User.</span></div>
				<?php }if(!is_null($create)){?>
				<div class="ui-bar ui-bar-a ui-corner-all"><span>Created user <?php print $create; ?>.</span></div>
				<?php }?>
				<a href="/admin/users/create" class="ui-btn ui-input-btn ui-corner-all ui-shadow">Create User</a>
				<ul class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
					<?php foreach($users as $user){ ?>
					<li class="ui-li-static ui-body-inherit ui-first-child">
						<h3><?php print $user->username; ?></h3>
						<ul>
							<li>Email: <?php print $user->email; ?></li>
						</ul>
						<p>
						<a href="/admin/users/edit/<?php print $user->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Edit</a>
						<a href="/admin/users/delete/<?php print $user->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Delete</a>
						</p>
					</li>
					<?php }?>
				</ul>
				<a href="/admin/projects" class="ui-btn ui-input-btn ui-corner-all ui-shadow">Manage Projects</a>
				<a href="/admin/logout">Logout</a>
			</div>
		</div>
	</body>
</html>