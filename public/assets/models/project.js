define(["jquery", "backbone", "collections/packages", "collections/items"], function($, Backbone, Packages, Items) {
	var Project = Backbone.Model.extend({
		initialize: function() {
			this.on("change:sheet_options", function() {
				this.sheet_options_array = this.attributes.sheet_options.split(", ");
			});
			this.on("change:sheet_prices", function() {
				this.sheet_prices_array = this.attributes.sheet_prices.split(", ");
			});
			this.packages = new Packages(null, {project_id: this.id});
			
			this.items = new Items(null, {project_id: this.id});
			
		},
		idAttribute: "lookup_id",
		urlRoot: "/api/project",
		photo_id: ""
	});
	return Project;
});