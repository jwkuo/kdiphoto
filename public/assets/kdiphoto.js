require.config({
	baseUrl: "../assets",
	paths: {
		"jquery":"jquery-2.1.4.min",
		"jquerymobile":"jquery.mobile-1.4.5/jquery.mobile-1.4.5.min",
		"backbone":"backbone-min",
		"underscore":"underscore-min"
	},
	shim: {
		"backbone": {
			"deps": ["underscore", "jquery"],
			"exports":"Backbone"
		}
	},
	urlArgs: "bust=" + (new Date()).getTime()
});

//Require disablement of anchor click handling and listening of hash changes
require(["jquery","backbone","routers/router"], function($, Backbone, MainRouter){
	$(document).on("mobileinit", function(){
		$.mobile.linkBindingEnabled = false;
		$.mobile.hashListeningEnabled = false;
	});
	//Require the main router
	require(["jquerymobile"], function(){
		this.router = new MainRouter();
	});
});