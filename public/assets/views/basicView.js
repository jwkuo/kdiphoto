define(["jquery", "backbone"], function($, Backbone){
	var basicView = Backbone.View.extend({
		initialize: function() {
			$("#kdiphoto").on("change", this.render, this);
		},
		render: function() {
			if(this.collection.page == "home"){
				this.template = _.template($("script#contact-template").html(), this.collection);
				this.$el.find("header").append(this.template);
			}
			return this;
		}
	});
	return basicView;
});