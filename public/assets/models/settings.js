define(["jquery", "backbone"], function($, Backbone) {
	var Settings = Backbone.Model.extend({
		defaults: function() {
			return {
				page: "default",
				key: "default",
				value: "default"
			};
		}
	});
	return Settings;
});