define(["jquery", "backbone", "models/project"], function($, Backbone, Project){
	var OrderFormView = Backbone.View.extend({
		events: {
			"change #sheet-qty": "sheet_selection_render",
			"change ul#sheet-options select": "checkout_render",
			"click .package-controls input[type='button']": "add_package",
			"click .item-controls input[type='button']": "add_item",
		},
		
		preview_template: _.template($("script#preview-template").html()),
		
		package_template: _.template($("script#package-template").html()),
		
		sheets_template: _.template($("script#sheets-template").html()),
		
		sheets_selection_template: _.template($("script#sheets-selection-template").html()),
		
		items_template: _.template($("script#items-template").html()),
		
		paypal_item_template: _.template($("script#paypal-item-template").html()),
		
		detail_template: _.template($("script#detail-template").html()),
		
		cart: {packages: new Array(), sheets: 0, items: new Array()},
		
		render: function() {
			var form = '';
			if(this.project.packages.length){
				form += this.package_template({packages: this.project.packages, options: this.project.sheet_options_array});
			}
			form += this.sheets_template({prices: this.project.sheet_prices_array, options: this.project.sheet_options_array});
			form += this.items_template({items: this.project.items});
			
			$(".preview").html(this.preview_template({directory: this.project.get("directory"), photo_id: this.project.get("photo_id")}));
			this.$el.html(form).enhanceWithin();
			this.cart = {packages: new Array(), sheets: 0, items: new Array()};
			this.checkout_render();
			this.delegateEvents();
			$("#checkout-footer input#toggle-details").off();
			$("#checkout-footer input#toggle-details").on("click", this.toggle_details);
			$("#checkout-footer #details").hide();
			return this;
		},
		
		sheet_selection_render: function() {
			var sheet_qty = this.$el.find("#sheet-qty option:selected");
			var qty = sheet_qty.val();
			this.cart.sheets = qty;
			$("#order-form #sheet-options").html(this.sheets_selection_template({sheets: qty, options: this.project.sheet_options_array}));
			this.checkout_render();
			$("#order-form").enhanceWithin();
			this.delegateEvents();
		},
		
		add_package: function(e) {
			var id = e.target.id.substring(12);
			var p = this.project.packages.get(id);
			var qty = $("#package-"+id+" .package-controls input#package-qty-"+id).val();
			var name = p.get("name");
			if(p.get("sheet_options") > 0){
				var sheet_list = "";
				for(i=1; i <= p.get("sheet_options"); i++){
					var sheet = $("#package-"+id+" .package-info .sheet-options #sheet-"+i).val();
					sheet_list = sheet_list+sheet+", ";
				}
				name = name+": "+sheet_list.substring(0, sheet_list.length-2);
			}
			var item = {name: name, price: p.get("price"), qty: qty};
			this.cart.packages.push(item);
			this.checkout_render();
		},
		
		add_item: function(e) {
			var id = e.target.id.substring(4);
			var item = this.project.items.get(id);
			if(item.get("multi")){
				var qty = $(".item-controls #qty-"+id).val();
			}else{
				var qty = 1;
			}
			if(item.get("input_option") == 1){
				var name = item.get("name")+": "+$(".item-input #input-"+id).val();
			}else{
				var name = item.get("name");
			}
			this.cart.items.push({name: name, price: item.get("price"), qty: qty});
			this.checkout_render();
		},
		
		checkout_render: function() {
			var cart_el = $("#checkout-footer #summary form #cart");
			var detail_el = $("#checkout-footer #summary ul#details");
			var total = 0;
			cart_el.empty();
			detail_el.empty();
			_.each(this.cart.packages, function(item, id) {
				cart_el.append(this.paypal_item_template({item: item, index: id+1, photo_id: this.project.get("photo_id")}));
				detail_el.append(this.detail_template({id: "package-"+id, name: item.name, price: item.price*item.qty, qty: item.qty}));
				total = total+(item.price*item.qty);
			}, this);
			var paypal_index = this.cart.packages.length;
			if(this.cart.sheets > 0){
				var sheet_options = "";
				for(i=1; i <= this.cart.sheets; i++){
					sheet_options = sheet_options+$("#sheet-options #sheet-"+i+" option:selected").val()+", ";
				}
				var sheet_item = {
						name: "Sheets: "+ sheet_options.substring(0, sheet_options.length-2), 
						qty: 1, 
						price: parseFloat(this.project.sheet_prices_array[this.cart.sheets-1].substring(1))
				};
				paypal_index++;
				cart_el.append(this.paypal_item_template({item: sheet_item, index: paypal_index, photo_id: this.project.get("photo_id")}));
				detail_el.append(this.detail_template({id: "sheets", name: sheet_item.name, price: sheet_item.price, qty: this.cart.sheets}));
				total = total+sheet_item.price;
			}
			paypal_index++;
			_.each(this.cart.items, function(item, id) {
				cart_el.append(this.paypal_item_template({item: item, index: paypal_index, photo_id: this.project.get("photo_id")}));
				detail_el.append(this.detail_template({id: "item-"+id, name: item.name, price: item.price*item.qty, qty: item.qty}));
				paypal_index++;
				total = total+(item.price*item.qty);
			}, this);
			if(total > 0){
				$("#checkout-footer").slideDown();
				$("#checkout-footer #summary #details input[type='button']").on("click", this, this.delete_cart_item);
				var item_ids = new Array();
				$("#order-form ul.order-form-section li.auto input[type='button']").each(function(index){
					item_ids[index] = this.id.substring(4);
				});
				_.each(item_ids, function(item_id, index){
					var item = this.project.items.get(item_id);
					var cart_item = {name: item.attributes.name, price: item.attributes.price, qty: 1};
					cart_el.append(this.paypal_item_template({item: cart_item, index: paypal_index, photo_id: this.project.get("photo_id")}));
					detail_el.append(this.detail_template({id: "item-"+item_id, name: cart_item.name, price: cart_item.price*cart_item.qty, qty: cart_item.qty}));
					total = total+(cart_item.price*cart_item.qty);
					paypal_index++;
				}, this);
			}else{
				$("#checkout-footer").slideUp();
			}
			$("#checkout-footer h3").html("Order Total - $"+total.toFixed(2));
			$("#checkout-footer").enhanceWithin();
		},
		
		toggle_details: function() {
			$("#checkout-footer #details").slideToggle();
			$("#checkout-footer .ui-btn").toggleClass("ui-icon-carat-u");
			$("#checkout-footer .ui-btn").toggleClass("ui-icon-carat-d");
		},
		
		delete_cart_item: function(e) {
			var id = e.target.id.substring(7);
			if(id.substring(0,8) == "package-"){
				e.data.cart.packages.splice(id.substring(8), 1);
			}else if(id == "sheets"){
				e.data.cart.sheets = 0;
				$("#order-form #sheet-qty").val("0");
				$("#order-form #sheet-qty-button span").html($("#order-form #sheet-qty option[value='0']").html());
				e.data.sheet_selection_render();
			}else if(id.substring(0,5) == "item-"){
				e.data.cart.items.splice(id.substring(5), 1);
			}
			e.data.checkout_render();
		}
	});
	return OrderFormView;
});