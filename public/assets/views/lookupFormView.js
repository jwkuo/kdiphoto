define(["jquery", "backbone", "models/project"], function($, Backbone, Project){
	var LookupFormView = Backbone.View.extend({
		events: {
			"submit":"lookupPhoto"
		},
		lookupPhoto: function(e){
			e.preventDefault();
			//Get the input from the form
			this.lookup_id = this.el[0].value;
			this.photo_id = this.el[1].value;
			Backbone.history.navigate("order",{trigger: true});
		}
	});
	return LookupFormView;
});