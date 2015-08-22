<!doctype html>
<html>
	<head>
		<title>KDI Photo - Manage Projects</title>
		<link rel="stylesheet" href="/assets/admin.css">
		<link rel="stylesheet" href="/assets/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	</head>
	<body class="ui-mobile-viewport ui-overlay-a">
		<div class="main-wrapper ui-content">
			<header>
			<img alt="KDI Photo" src="/assets/kdi-logo.png">
			</header>
			<div class="container ui-body ui-body-a ui-corner-all">
				<h1>Manage Projects</h1>
				<?php if (!is_null($delete) && $delete){?>
				<div class="ui-bar ui-bar-a ui-corner-all"><span>Project deleted.</span></div>
				<?php }if(!is_null($update) && $update){?>
				<div class="ui-bar ui-bar-a ui-corner-all"><span>Updated Project.</span></div>
				<?php }?>
				<a href="/admin/projects/create" class="ui-btn ui-input-btn ui-corner-all ui-shadow">Create Project</a>
				<ul class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
					<?php foreach($projects as $project){ ?>
					<li class="ui-li-static ui-body-inherit ui-first-child">
						<h3><?php print $project->name; ?></h3>
						<p><b>Lookup ID</b>: <?php print $project->lookup_id; ?></p>
						<p><b>Directory</b>: <?php print $project->directory; ?></p>
						<p>
						<a href="/admin/projects/<?php print $project->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Edit</a>
						<a href="/admin/projects/copy/<?php print $project->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Copy</a>
						<a href="/admin/projects/delete/<?php print $project->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Delete</a>
						</p>
					</li>
					<?php }?>
				</ul>
				<a href="/admin/users" class="ui-btn ui-input-btn ui-corner-all ui-shadow">Manage Users</a>
				<a href="/admin/logout">Logout</a>
			</div>
		</div>
	</body>
</html>