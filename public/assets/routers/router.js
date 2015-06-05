define(["jquery", "backbone", "views/basicView", "models/settings", "collections/settings"], function($, Backbone, View, SettingsModel, Settings){
	var MainRouter = Backbone.Router.extend({
		initialize: function() {
			this.homeView = new View({el:"#home", collection: new Settings([], {page: "home"})});
			this.lookupView = new View({el:"#lookup-photo", collection: new Settings([], {page: "lookup-photo"})});
			Backbone.history.start();
		},
		routes: {
			"":"home",
			"#home":"home",
			"#lookup-photo":"lookup"
		},
		home: function () {
			if(!this.homeView.collection.length){
				$.mobile.loading("show");
				this.homeView.collection.fetch().done(function() {
					$("#kdiphoto").change("#home", {reverse:false, changeHash:false});
					$.mobile.loading("hide");
				});
			}else {
				$("#kdiphoto").change("#home", {reverse:false, changeHash:false});
			}
		},
		lookup: function () {
			$("#kdiphoto").change("#lookup-photo", {reverse:false, changeHash:false});
		}
	});
	return MainRouter;
});