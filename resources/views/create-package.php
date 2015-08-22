<!doctype html>
<html>
	<head>
		<title>KDI Photo - Create Package</title>
		<link rel="stylesheet" href="/assets/admin.css">
		<link rel="stylesheet" href="/assets/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	</head>
	<body class="ui-mobile-viewport ui-overlay-a">
		<div class="main-wrapper ui-content">
			<header>
			<img alt="KDI Photo" src="/assets/kdi-logo.png">
			</header>
			<div class="container ui-body ui-body-a ui-corner-all">
				<h1>Create Package</h1>
				<form action="/admin/projects/<?php print $project_id; ?>/packages/create" method="POST">
					<div class="ui-field-contain">
						<label for="name">Package Name:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="name" id="name">
						</div>
					</div>
					<div class="ui-field-contain">
						<label for="price">Price: &nbsp;$</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="price" id="price">
						</div>
					</div>
					<div class="ui-field-contain">
						<label for="description">Description:</label>
						<textarea cols="40" rows="8" name="description" id="description" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow"></textarea>
					</div>
					<div class="ui-field-contain">
						<label for="sheet_options">Sheet Choices:</label>
						<input type="number" name="sheet_options" id="sheet_options" value="0" min="0" max="20" class="ui-shadow-inset ui-body-inherit ui-corner-all">
					</div>
					<div class="ui-field-contain">
						<div class="ui-btn ui-input-btn ui-corner-all ui-shadow">
							Create
							<input type="submit" value="Create">
						</div>
					</div>
					<a href="/admin/projects/<?php print $project_id; ?>">Cancel</a>
				</form>
			</div>
		</div>
	</body>
</html>