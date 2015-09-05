require.config({
	baseUrl: "../assets",
	paths: {
		"jquery":"jquery-2.1.4.min",
		"jquerymobile":"jquery.mobile-1.4.5/jquery.mobile-1.4.5.min",
		"backbone":"backbone",
		"underscore":"underscore"
	},
	shim: {
		"backbone": {
			"deps": ["underscore", "jquery"],
			"exports":"Backbone"
		}
	},
	map: {
		"scooch/scooch": {
			"$": "jquery"
		}
	}
});

//Require disablement of anchor click handling and listening of hash changes
require(["jquery","backbone","routers/router"], function($, Backbone, MainRouter){
	$(document).on("mobileinit", function(){
		$.mobile.linkBindingEnabled = false;
		$.mobile.hashListeningEnabled = false;
	    $.mobile.pushStateEnabled = false;
	    $.mobile.ajaxEnabled = false;
	});
	//Setup scooch
	require(["scooch/scooch"], function(){
		$(".m-scooch").scooch();
		var sindex = 1;
		setInterval(function() {
			sindex = sindex + 1;
			if(sindex < 6){
				$(".m-scooch").scooch("next");
			}else{
				$(".m-scooch").scooch("move", 1);
				sindex = 1;
			}
		}, 3000);
	});
	//Require the main router
	require(["jquerymobile"], function(){
		this.router = new MainRouter();
	});
	Backbone.history.start();
	$("body").attr("style", "visibility: visible;");
});