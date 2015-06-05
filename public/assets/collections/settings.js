define(["jquery", "backbone", "models/settings"], function($, Backbone, SettingsModel) {
	var SettingsCol = Backbone.Collection.extend({
		initialize: function(models, options) {
			this.page = options.page;
			this.url = "/kdiphoto.php/settings/"+this.page;
		},
		model: SettingsModel,
		getsetting: function(key) {
			var model = _.find(this.collection, function(model){return model.key == key});
			return model.value;
		}
	});
	return SettingsCol;
});