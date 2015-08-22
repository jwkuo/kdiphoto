<!doctype html>
<html>
	<head>
		<title>KDI Photo - Edit Item</title>
		<link rel="stylesheet" href="/assets/admin.css">
		<link rel="stylesheet" href="/assets/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
		<script type="text/javascript" src="/assets/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="/assets/jquery.mobile-1.4.5/jquery.mobile-1.4.5.js"></script>
	</head>
	<body class="ui-mobile-viewport ui-overlay-a">
		<div class="main-wrapper ui-content">
			<header>
			<img alt="KDI Photo" src="/assets/kdi-logo.png">
			</header>
			<div class="container ui-body ui-body-a ui-corner-all">
				<h1>Create Item</h1>
				<form action="/admin/projects/<?php print $project_id; ?>/items/<?php print $item->id; ?>" data-ajax="false" method="POST">
					<div class="ui-field-contain">
						<label for="name">Item Name:</label>
						<input type="text" name="name" id="name" value="<?php print $item->name; ?>">
					</div>
					<div class="ui-field-contain">
						<label for="price">Price:</label>
						<input type="text" name="price" id="price" value="<?php print $item->price; ?>">
					</div>
					<div class="ui-field-contain">
						<label for="description">Description:</label>
						<textarea cols="40" rows="8" name="description" id="description" class="ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow" value="<?php print $item->description; ?>"></textarea>
					</div>
					<div class="ui-controlgroup-controls ">
						<div class="ui-checkbox">
							<label for="multi" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-first-child ui-checkbox-off">
							Multiple: Customer can buy more than one of this item</label>
							<input type="checkbox" name="multi" id="multi" <?php $item->multi ? print 'checked="true"': print '';?>">
						</div>
						<div class="ui-checkbox">
							<label for="auto" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-checkbox-off">
							Auto Add to Order: Automatically add this item to the order</label>
							<input type="checkbox" name="auto" id="auto" <?php $item->auto ? print 'checked="true"': print '';?>">
						</div>
						<div class="ui-checkbox">
							<label for="input_option" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-checkbox-off ui-last-child">
							Input Option: Add an text input option for the customer to provide</label>
							<input type="checkbox" name="input_option" id="input_option" <?php $item->input_option ? print 'checked="true"': print '';?>">
						</div>
						<div class="ui-field-contain">
							<label for="input_label">Text Input Label:</label>
							<input type="text" name="input_label" id="input_label" value="<?php print $item->input_label; ?>">
						</div>
					</div>
					<div class="ui-field-contain">
						<input type="submit" value="Save Item">
					</div>
					<a data-ajax="false" href="/admin/projects/<?php print $project_id; ?>">Cancel</a>
				</form>
			</div>
		</div>
	</body>
</html>