define(["jquery", "backbone", "views/lookupFormView", "views/orderFormView", "models/project"], function($, Backbone, lookupFormView, orderFormView, Project){
	var MainRouter = Backbone.Router.extend({
		initialize: function() {
			this.lookupForm = new lookupFormView({el:"#lookup-form", router: this});
			this.orderForm = new orderFormView({el:"#order-form"});
		},
		routes: {
			"":"home",
			"home":"home",
			"lookup":"lookup",
			"order":"order"
		},
		home: function () {
			$(":mobile-pagecontainer").pagecontainer("change", "#home", {reverse:false, changeHash:false});
		},
		lookup: function () {
			$(":mobile-pagecontainer").pagecontainer("change", "#lookup", {reverse:false, changeHash:false});
		},
		order: function () {
			$(".ui-loader").show();
			$(".preview").hide();
			$("#order-form").hide();
			$("#lookup-error").hide();
			$("#checkout-footer").hide();
			var orderForm = this.orderForm;
			var lookupForm = this.lookupForm;
			if(!lookupForm.hasOwnProperty("lookup_id")){
				//redirect to lookup form
				this.navigate("lookup",{trigger: true});
				return;
			}
			orderForm.project = new Project({lookup_id: lookupForm.lookup_id, photo_id: lookupForm.photo_id});
			
			orderForm.project.fetch({
				success: function(model, response, options) {
					model.packages.fetch().done(function(){
						model.packages.filter();
						model.items.fetch().done(function(){
							model.items.filter();
							orderForm.render();
							$(".ui-loader").hide();
							$(".preview").show();
							$("#order-form").show();
						});
					});
				},
				error: function() {
					$(".ui-loader").hide();
					$("#lookup-error").show();
				}
			});
			
			//Send the views back to the router
			this.orderForm = orderForm;
			this.lookupForm = lookupForm;
			
			$(":mobile-pagecontainer").pagecontainer("change", "#order", {reverse:false, changeHash:false});
			
		}
	});
	return MainRouter;
});