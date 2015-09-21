<!doctype html>
<html>
	<head>
		<title>KDI Photo - Edit Project</title>
		<link rel="stylesheet" href="/assets/admin.css">
		<link rel="stylesheet" href="/assets/jquery.mobile-1.4.5/jquery.mobile-1.4.5.css">
	</head>
	<body class="ui-mobile-viewport ui-overlay-a">
		<div class="main-wrapper ui-content">
			<header>
			<img alt="KDI Photo" src="/assets/kdi-logo.png">
			</header>
			<div class="container ui-body ui-body-a ui-corner-all">
				<h1>Edit Project</h1>
				<form action="/admin/projects/<?php print $project->id; ?>" method="POST">
					<div class="ui-field-contain">
						<label for="name">Project Name:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="name" id="name" value="<?php print $project->name; ?>">
						</div>
					</div>
					<div class="ui-field-contain">
						<label for="lookup_id">Lookup ID:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="lookup_id" id="lookup_id" value="<?php print $project->lookup_id; ?>">
						</div>
					</div>
					<p>Set the ID that customers will use to lookup their photo. (i.e. lfpdo-2015) 
					The lookup ID may match the directory name if you choose.</p>
					<div class="ui-field-contain">
						<label for="directory">Directory:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="directory" id="directory" value="<?php print $project->directory; ?>">
						</div>
					</div>
					<p>Set the directory (folder) name where the photos will reside. (i.e. 2105lfpdo) 
					The directory name may match the lookup ID if you choose.</p>
					<div class="ui-bar ui-bar-a ui-corner-all"><h2>Packages</h2></div>
					<a href="/admin/projects/<?php print $project->id; ?>/packages/create" class="ui-btn ui-input-btn ui-corner-all ui-shadow">Create Package</a>
					<p>A package is a collection of sheets for a special price. 
					You can set an amount of sheet choices the customer can choose for him or herself.</p>
					<ul class="ui-listview ui-listview-inset ui-corner-all ui-shadow" id="packages">
						<?php foreach($project->packages as $package){ ?>
						<li class="ui-li-static ui-body-inherit ui-first-child">
							<h3><?php print $package->name; ?></h3>
							<ul id="<?php print $package->id; ?>-attributes">
								<li>Price: $<?php print $package->price; ?></li>
								<li>Sheet Options: <?php print $package->sheet_options; ?></li>
							</ul>
							<p>
							<a href="/admin/projects/<?php print $project->id; ?>/packages/<?php print $package->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Edit</a>
							<a href="/admin/projects/<?php print $project->id; ?>/packages/delete/<?php print $package->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Delete</a>
							</p>
						</li>
						<?php }?>
					</ul>
					<div class="ui-bar ui-bar-a ui-corner-all"><h2>Sheet Options</h2></div>
					<div class="ui-field-contain">
						<label for="sheet_options">Sheet Options:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="sheet_options" id="sheet_options" value="<?php print $project->sheet_options; ?>">
						</div>
					</div>
					<p>Provide a list of Sheet Options that a customer can choose from.
					List the names of your sheets separated by a comma. (i.e. 8X10 (1), 5X7 (2), Wallets (8))</p>
					<div class="ui-bar ui-bar-a ui-corner-all"><h2>Sheet Prices</h2></div>
					<div class="ui-field-contain">
						<label for="sheet_prices">Sheet Prices:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="text" name="sheet_prices" id="sheet_prices" value="<?php print $project->sheet_prices; ?>">
						</div>
					</div>
					<p>Set the prices in order of quantity.
					The number of prices determines the number of sheets a customer may buy.
					List the prices of your sheets separated by a comma. (i.e. $12.00, $22.00, $30.00)</p>
					<div class="ui-bar ui-bar-a ui-corner-all"><h2>Sheet Promotion (Optional)</h2></div>
					<div class="ui-field-contain">
						<label for="sheet_prices">Sheet Promo Text:</label>
						<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
							<input type="textarea" name="sheet_promo" id="sheet_promo" value="<?php print $project->sheet_promo; ?>">
						</div>
					</div>
					<p>Provide a promotional text for purchasing sheets. (i.e. FREE 5.x7 class photo with 3 or more sheets!)</p>
					<div class="ui-bar ui-bar-a ui-corner-all"><h2>Individuals, Add Ons, and Tack Ons</h2></div>
					<a href="/admin/projects/<?php print $project->id; ?>/items/create" class="ui-btn ui-input-btn ui-corner-all ui-shadow">Create Item</a>
					<p>Got a special sheet for a fixed price? An option to add to all sheets? Need to tack on a shipping fee?
					These items will get the job done!</p>
					<ul class="ui-listview ui-listview-inset ui-corner-all ui-shadow" id="items">
						<?php foreach($project->items as $item){ ?>
						<li class="ui-li-static ui-body-inherit ui-first-child">
							<h3><?php print $item->name; ?></h3>
							<ul id="<?php print $item->id; ?>-attributes">
								<li>Price: $<?php print $item->price; ?></li>
								<li>Buy Multiple: <?php $item->multi ? print 'Yes' : print 'No'; ?></li>
								<li>Auto Add to Order: <?php $item->auto ? print 'Yes' : print 'No';?></li>
							</ul>
							<p>
							<a href="/admin/projects/<?php print $project->id; ?>/items/<?php print $item->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Edit</a>
							<a href="/admin/projects/<?php print $project->id; ?>/items/delete/<?php print $item->id; ?>" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-carat-r ui-btn-icon-right">Delete</a>
							</p>
						</li>
						<?php }?>
					</ul>
					<div class="ui-field-contain">
						<div class="ui-btn ui-input-btn ui-corner-all ui-shadow">
							Save Project
							<input type="submit" value="Save Project">
						</div>
					</div>
					<a href="/admin/projects">Cancel</a>
				</form>
			</div>
		</div>
	</body>
</html>