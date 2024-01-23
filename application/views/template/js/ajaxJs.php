<script type="text/javascript">

	$(document).ready(function(){

		$.setCategories = function( q ){
			/*Categories Listing*/
			var categories_query = Object.assign({}, q);
		    $.ajax({
		        url: '<?php echo base_url(); ?>api/categories/get_all_categories',
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		var categoriesview = ``;
		        		var rootcat_id =1;
		        		$.recursive = function(json_res, child_ids){
						   
						   $.each(child_ids,function(index,value){
						   		categories_query.catids = Array(value);
						   		if(json_res.data[value].child_ids.length==0){
						   			categoriesview += `<li><a href='<?php echo base_url(); ?>product/list?q=${JSON.stringify(categories_query)}'>${json_res.data[value].name}<i class="fas fa-chevron-right"></i></a></li>`;
						   			return;
						   		}
						   		categoriesview += `<li class="hassubs">
									<a href='<?php echo base_url(); ?>product/list?q=${JSON.stringify(categories_query)}'>${json_res.data[value].name}<i class="fas fa-chevron-right"></i></a>
									<ul>`;
						   		$.recursive(json_res,json_res.data[value].child_ids);
						   		categoriesview += `</ul>
								</li>`;
						   });
						}
						$.recursive(json_res,json_res.data[rootcat_id].child_ids);
						$(".cat_menu").append(categoriesview);
		        	}
		        	if( $(".sidebar_categories")[0] ){
		        		$(".sidebar_categories").append(`<li><a href="#">${json_res.data[q.catids[0]].name}</a></li>`);
		        	}
		        	
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
		    /*Categories Listing*/
		}


		$.setPopularCategories = function( q ){
			/*Popular Categories Listing*/
		    $.ajax({
		        url: '<?php echo base_url(); ?>api/categories/get_all_categories',
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		var categoriesview = ``;
		        		var rootcat_id =1;
					   $.each(json_res.data[rootcat_id].child_ids,function(index,value){
					   		

					   		$('.popular_categories_slider').trigger('add.owl.carousel', [`
					   			<div class="owl-item">
									<div class="popular_category d-flex flex-column align-items-center justify-content-center">
										
										<a href='<?php echo base_url(); ?>product/list?q={"catids":[${value}]}'><div class="popular_category_text">${json_res.data[value].name}</div></a>
									</div>
								</div>
					   		`]).trigger('refresh.owl.carousel');
					   });
		        	}
		        	
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
		    /*Popular Categories Listing*/
		}

		$.setFilter = function( q ){
			/*Filter Listing*/
			var filter_query = Object.assign({}, q);
			$.ajax({
		        url: `<?php echo base_url(); ?>api/filter/get?q=${JSON.stringify(filter_query)}`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		$.each(json_res.data,function(index,value){
		        			
		        			var filterview = `<div class="sidebar_section">
								<div class="sidebar_subtitle filter_subtitle">${value.name}</div>
								<ul class="colors_list">`;
							var checked = '';
							$.each(value.values,function(index2,value2){
								if( typeof filter_query.filter !== 'undefined' && typeof filter_query.filter[index] !== 'undefined' && filter_query.filter[index].indexOf(index2) != -1 ){
									checked = "checked";
								}else{
									checked = "";
								}
								filterview += `<li class="filter_value"><div class="checkbox">
								  <label><input type="checkbox" data-name="${index}" data-value="${index2}" ${checked}> ${value2}</label>
								</div></li>`;
							});
							filterview += `</ul>
							</div>`;

		        			$(".shop_sidebar").append(filterview);
		        		});
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
			/*Filter Listing*/
		}


		$.setProductList = function( q ){
			/*Product Listing*/
			var product_query = Object.assign({}, q);
			if(typeof product_query.filter == 'undefined'){
				product_query.filter = {};
			}
			if(typeof product_query.sort == 'undefined'){
				product_query.sort = 0;
			}
			if(typeof product_query.pg == 'undefined'){
				product_query.pg = 0;
			}
		    $.ajax({
		        url: `<?php echo base_url(); ?>api/products/get_products?q=${JSON.stringify(product_query)}`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	$(".shop_product_count").text("Products Not Found");
		        	if(json_res.status == 200){
		        		if(product_query.pg<=0){
		        			$('.page_prev').attr('style','display:none !important');
		        		}else{
		        			$('.page_prev').attr('style','display:flex !important');
		        		}
		        		$('.page_next').attr('style','display:none !important');

		        		$.each(json_res.data,function(index,value){
		        			var thumbnail = null;
		        			$.each(value.media,function(index2,value2){
								thumbnail = value2.thumbnail;
								return;
							});
		        			product_query.product_id = index;
		        			var productview = `
		        				<div class="product_item is_new">
									<div class="product_border"></div>
									<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="${thumbnail}" alt=""></div>
									<div class="product_content">
										<div class="product_price">${value.discount_price}<span>${value.regular_price}</span></div>
										<div class="product_name"><div><a href='<?php echo base_url(); ?>product/detail?q=${JSON.stringify(product_query)}' tabindex="0">${value.name}</a></div></div>
									</div>
									<div class="product_fav"><i class="fas fa-heart"></i></div>
									<ul class="product_marks">
										<li class="product_mark product_discount">${2}</li>
										<li class="product_mark product_new">new</li>
									</ul>
								</div>
		        			`;

		        			$(".product_grid").append(productview);
		        			$('.product_grid').isotope( 'reloadItems' ).isotope();
		        			$(".shop_product_count").text("Products Found");
		        			
		        			$('.page_next').attr('style','display:flex !important');
		        		});
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
			        $(".shop_product_count").text("Products Not Found");
			        $('.page_next').attr('style','display:none !important');
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
			    	}
			    }
		    });
		    /*Product Listing*/
		}


		$.setSorting = function( q ){
			/*Filter Listing*/
			var sort_query = Object.assign({}, q);
			$.ajax({
		        url: `<?php echo base_url(); ?>api/sorting/get`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		$.each(json_res.data,function(index,value){
		        			var sortview = `<li class="shop_sorting_button" data-isotope-option='' data-value='${index}'>${value}</li>`;
		        			$(".shop_sorting").find("ul").find("ul").append(sortview);
		        		});
		        		$(".sorting_text").text(json_res.data[sort_query.sort]);
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
			/*Filter Listing*/
		}



		$.setProductDetail = function( q ){
			/*Product Detail*/
			var product_query = Object.assign({}, q);
		    $.ajax({
		        url: `<?php echo base_url(); ?>api/products/get_product_detail?q=${JSON.stringify(product_query)}`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		$(".product_name").text(json_res.data.name);
		        		var description  = json_res.data.description.replace(/\\n/g, '<br />');
		        		$(".product_text").find("p").html(description);
		        		$(".product_price").text(json_res.data.discount_price);
		        		$(".cart_button").val(json_res.data.id);
		        		$.each(json_res.data.media,function(index,value){
		        			$(".image_list").append(`<li data-image="${value.url}"><img src="${value.url}" alt=""></li>`);
		        			$(".image_selected").append(`<img src="${value.url}" alt="">`);
		        		});
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
		    /*Product Detail*/
		}

		$.setCart = function( q ){
			/*Cart*/
		    $.ajax({
		        url: `<?php echo base_url(); ?>api/cart/get`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		$(".cart_count").find('span').text(json_res.data.total_qty);
		        		$(".cart_price").text(json_res.data.total);
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
		    /*Cart*/
		}


		$.setCartList = function( q ){
			/*CartList*/
		    $.ajax({
		        url: `<?php echo base_url(); ?>api/cart/get`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		$.each(json_res.data.products,function(index,value){
		        			$(".cart_list").append(`
		        				<li class="cart_item clearfix">

									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">

										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">In Stock</div>
											<div class="cart_item_text">${value.aval}</div>
										</div>
										
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_title">Product Name</div>
											<div class="cart_item_text">${value.name}</div>
										</div>
										
										
										
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_title">Quantity</div>
											<div class="cart_item_text">${value.qty}</div>
										</div>
										
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_title">Price</div>
											<div class="cart_item_text">${value.price}</div>
										</div>

										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title">Total</div>
											<div class="cart_item_text">${value.sub_total}</div>
										</div>


										<div class="cart_item_total cart_info_col">
											<div class="cart_item_title"></div>
											<div class="cart_item_text">
												<button type="button" class="delete_item close" aria-label="Close" value='${value.id}'>
												  <span aria-hidden="true">&times;</span>
												</button>
											</div>
										</div>

									</div>
								</li>
								<hr>
		        			`);
		        		});
		        		$(".order_total_amount").text(json_res.data.total);
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
		    /*CartList*/
		}

		$.loginModal = function(){
			if( $("#modalLoginForm")[0] && window.localStorage.getItem("Authorization") == null ){
				$("#modalLoginForm").modal({
					backdrop: 'static',
	           		keyboard: false
				});
	    		$("#modalLoginForm").modal('show');
	    		
		    	$(".login").click(function(){
		    		var data = {
		    			"mobile" : $("#login_mobile").val(),
		    			"password" : $("#login_password").val()
		    		}

		    		$.ajax({
				        url: `<?php echo base_url(); ?>api/auth/login`,
				        type: 'POST',
				        data : JSON.stringify(data),
				        contentTypev: 'application/json',
				        success: function(json_res) {
				        	if(json_res.status == 200){
				        		window.localStorage.setItem("Authorization", json_res.data.id);
				        		window.localStorage.setItem("name", json_res.data.name);
				        		location.reload();
				        	}
				        },error:function (xhr, ajaxOptions, thrownError){
				        	var err = JSON.parse(xhr.responseText);
				        	switch (xhr.status) {
						        case 401:
						        	$(".error").html(err.error);
						            break;

						        case 400:
						        	$(".error").html(err.error);
						            break;

						        default: 
						        	break;
						    }
					    }
				    });
		    	});
	    		$.stop();

	    	}

		} 


		$.signupModal = function(){
			if( $("#modalsignupForm")[0] && window.localStorage.getItem("Authorization") == null ){
	    		$("#modalsignupForm").modal({
					backdrop: 'static',
	           		keyboard: false
				});
	    		$("#modalsignupForm").modal('show');

	    		$(".signup").click(function(){
		    		var data = {
		    			"name" : $("#name").val(),
		    			"mobile" : $("#mobile").val(),
		    			"password" : $("#password").val(),
		    			"address" : $("#address").val()
		    		}
		    		$.ajax({
				        url: `<?php echo base_url(); ?>api/auth/signup`,
				        type: 'POST',
				        data : JSON.stringify(data),
				        contentTypev: 'application/json',
				        success: function(json_res) {
				        	if(json_res.status == 200){
				        		window.localStorage.setItem("Authorization", json_res.data.id);
				        		window.localStorage.setItem("name", json_res.data.name);
				        		location.reload();
				        	}
				        },error:function (xhr, ajaxOptions, thrownError){
				        	var err = JSON.parse(xhr.responseText);
				        	switch (xhr.status) {
						        case 401:
						        	$(".error").html(err.error);
						            break;

						        case 400:
						        	$(".error").html(err.error);
						            break;

						        default: 
						        	break;
						    }
					    }
				    });
		    	});
		    	$.stop();
	    	}
		} 


		$.setAdverts = function(q){
			/*Adverts*/
			var adverts_query = Object.assign({}, q);
			if(typeof adverts_query.filter == 'undefined'){
				adverts_query.filter = {};
			}
			adverts_query.catids = [10];
			adverts_query.sort = 1;
			adverts_query.pg = 0; 
			console.log(JSON.stringify(adverts_query));
		    $.ajax({
		        url: `<?php echo base_url(); ?>api/products/get_products?q=${JSON.stringify(adverts_query)}`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){


		        		$.each(json_res.data,function(index,value){
		        			var thumbnail = null;
		        			$.each(value.media,function(index2,value2){
								thumbnail = value2.thumbnail;
								return;
							});
		        			adverts_query.product_id = index;
		        			$(".adverts").find(".row").append(`
		        				<div class="col-lg-4 advert_col">
									<div class="advert d-flex flex-row align-items-center justify-content-start">
										<div class="advert_content">
											<div class="advert_title_2"><a href='<?php echo base_url(); ?>product/detail?q=${JSON.stringify(adverts_query)}'>${value.name}</a></div>
											<div class="advert_text">${value.short_description}</div>
											<div class="advert_subtitle">${value.discount_price}</div>
										</div>
										<div class="ml-auto"><div class="advert_image"><img src="${thumbnail}" alt=""></div></div>
									</div>
								</div>
		        			`);

		        		});

		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
		    /*Adverts*/
		}



		$.setLocation = function( q ){
			/*location*/
			$(".location").hide();
			$.ajax({
		        url: `<?php echo base_url(); ?>api/location/get`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		$.each(json_res.data,function(index,value){
		        			$(".location").attr('name',index);
		        			
		        			$.each(value.values,function(index2,value2){
		        				var selected = '';
		        				if(typeof q.filter !== 'undefined' && typeof q.filter[index] !== 'undefined'){
									var pos = q.filter[index].indexOf(index2);
									if(  pos > -1 ){
										selected = 'selected';
									}
									
								}
		        				option = `<option data-tokens="${value2}" value="${index2}" ${selected}>${value2}</option>`;
		        				$(".location").append(option);
		        			});
		        		});
		        		$('.location').selectpicker('refresh');
		        		$(".location").show();
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
			/*location*/
		}



		$.setProdtype = function( q ){
			/*prodtype*/
			$(".prodtype").hide();
			$.ajax({
		        url: `<?php echo base_url(); ?>api/prodtype/get`,
		        type: 'GET',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        dataType: 'json', // added data type
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		$.each(json_res.data,function(index,value){
		        			$(".prodtype").attr('name',index);
		        			
		        			$.each(value.values,function(index2,value2){
		        				var selected = '';
		        				if(typeof q.filter !== 'undefined' && typeof q.filter[index] !== 'undefined'){
									var pos = q.filter[index].indexOf(index2);
									if(  pos > -1 ){
										selected = 'selected';
									}
									
								}
		        				option = `<option data-tokens="${value2}" value="${index2}" ${selected}>${value2}</option>`;
		        				$(".prodtype").append(option);
		        			});
		        		});
		        		$('.prodtype').selectpicker('refresh');
		        		$(".prodtype").show();
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	var err = JSON.parse(xhr.responseText);
		        	switch (xhr.status) {
				        case 401:
				        	window.localStorage.clear();
				        	window.location.reload();
				            break;

				        default: 
				        	break;
				    }
			    }
		    });
			/*prodtype*/
		}








		$(".username").text(localStorage.getItem('name'));
		$(".logout").click(function(){
			window.localStorage.clear();
			window.location.reload();
		});

	});
</script>