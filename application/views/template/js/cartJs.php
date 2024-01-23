<script src="<?php echo base_url("assets/layout"); ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/easing/easing.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/js/cart_custom.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<?php $this->load->view("template/js/ajaxJs"); ?>

<script type="text/javascript">
	$(document).ready(function(){
		$.loginModal();
		$.signupModal();
		$.setCart();
		$.setCategories(q);
		$.setCartList(q);


		$(".cart_button_checkout").click(function(){
			var bool = confirm(`Checkout`);

			if( bool ){
				$(".cart_buttons").html("Please Wait...");
				$.ajax({
			        url: `<?php echo base_url(); ?>api/order/now`,
			        type: 'POST',
			        headers: {"Authorization": localStorage.getItem('Authorization')},
			        data : JSON.stringify({online:1}), 
			        contentTypev: 'application/json',
			        success: function(json_res) {
			        	if(json_res.status == 200){
			        		var order_id = json_res.data.order_id;
			        		/*$(".cart_buttons").html(`Order Placed Successfully With Order ID ${json_res.data.order_id}`);*/

			        		/*PAY*/
			        		var options = json_res.data.detail;
			        		options.handler = function (response){
							    data  = {
							    	order_id : order_id,
							    	payment_id : response.razorpay_payment_id,
							    	signature : response.razorpay_signature
							    }

							    $.ajax({
								        url: `<?php echo base_url(); ?>api/order/trans_verify`,
								        type: 'POST',
								        headers: {"Authorization": localStorage.getItem('Authorization')},
								        data : JSON.stringify(data), 
								        contentTypev: 'application/json',
								        success: function(json_res) {
								        	if(json_res.status == 200){
								        		$(".cart_buttons").html(`Order Placed Successfully With Order ID ${order_id} And Transaction Id ${response.razorpay_payment_id}`);
								        	}
								        },error:function (xhr, ajaxOptions, thrownError){
								        	switch (xhr.status) {
										        case 404:
										        	$(".cart_buttons").html(`transaction failed. order id not found.`);
										            break;

										        case 400:
										        	$(".cart_buttons").html('transaction failed.');
										            break;

										        case 401:
										        	window.localStorage.clear();
										        	window.location.reload();
										            break;

										        default: 
										        	$(".cart_buttons").html(`Unknown`);
										        	break;
										    }
								        	
									    }
								    });

							};
							/*options.theme.image_padding = false;*/
							options.modal = {
							    ondismiss: function() {
							    	$("#modal-close").hide();
							        console.log("This code runs when the popup is closed");
							    },
							    escape: false,
							    backdropclose: false
							};
							var rzp = new Razorpay(options);
							rzp.open();
							/*PAY*/


			        	}
			        },error:function (xhr, ajaxOptions, thrownError){
			        	switch (xhr.status) {
					        case 404:
					        	$(".cart_buttons").html(`Cart is empty`);
					            break;

					        case 409:
					        	$(".cart_buttons").html(`Some Products are out of stock, remove that from cart.`);
					            break;

					        case 401:
					        	window.localStorage.clear();
					        	window.location.reload();
					            break;

					        default: 
					        	$(".cart_buttons").html(`Unknown`);
					        	break;
					    }
			        	
				    }
			    });
			}
		});


		$(".cart_list").on("click",".delete_item",function(){
			data ={ "product_id" : $(this).val() }
			$(this).parent().html("Please Wait...");
			$.ajax({
		        url: `<?php echo base_url(); ?>api/cart/delete`,
		        type: 'POST',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        data : JSON.stringify(data),
		        contentTypev: 'application/json',
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		window.location.reload();
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
		});

	});
</script>
