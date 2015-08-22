define(["jquery", "backbone"], function($, Backbone) {
	var Items = Backbone.Collection.extend({
		initialize: function(models, options) {
			this.project_id = options.project_id;
		},
		filter: function() {
			var project_id = this.project_id;
			this.models = _.filter(this.models, function(model){
				return model.attributes.project.lookup_id == project_id;
			}, this);
			this.length = this.models.length;
		},
		url: "/api/items"
	});
	return Items;
})