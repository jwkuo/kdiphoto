<!doctype html>
<html>
	<head>
		<title>KDI Photo - Create Project</title>
		<link rel="stylesheet" href="/admin.css">
		<link rel="stylesheet" href="/assets/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	</head>
	<body class="ui-mobile-viewport ui-overlay-a">
		<div class="main-wrapper ui-content">
			<header>
			<img alt="KDI Photo" src="/assets/kdi-logo.png">
			</header>
			<div class="container ui-body ui-body-a ui-corner-all">
				<h1>Create Project</h1>
				<form action="/admin/projects/create" method="POST">
					<div class="ui-field-contain">
						<label for="name">Project Name:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="name" id="name">
						</div>
					</div>
					<p>Set the ID that customers will use to lookup their photo. (i.e. lfpdo-2015) 
					The lookup ID may match the directory name if you choose.</p>
					<div class="ui-field-contain">
						<label for="lookup_id">Lookup ID:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="lookup_id" id="lookup_id">
						</div>
					</div>
					<p>Set the directory (folder) name where the photos will reside. (i.e. 2105lfpdo) 
					The directory name may match the lookup ID if you choose.</p>
					<div class="ui-field-contain">
						<label for="directory">Directory:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="directory" id="directory">
						</div>
					</div>
					<div class="ui-field-contain">
						<div class="ui-btn ui-input-btn ui-corner-all ui-shadow">
							Create and Modify
							<input type="submit" value="Create and Modify">
						</div>
					</div>
					<a href="/admin/projects">Cancel</a>
				</form>
			</div>
		</div>
	</body>
</html>