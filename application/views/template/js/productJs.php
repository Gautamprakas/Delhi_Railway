<script src="<?php echo base_url("assets/layout"); ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/easing/easing.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/js/product_custom.js"></script>

<?php $this->load->view("template/js/ajaxJs"); ?>

<script type="text/javascript">
	$(document).ready(function(){
		$.loginModal();
		$.signupModal();
		$.setCart();
		$.setCategories(q);
		$.setProductDetail(q);

		$(".cart_button").click(function(){
			$(".cart_button").hide();
			var data = {
				product_id : $(".cart_button").val(), 
				qty : $("#quantity_input").val()
			}

			$.ajax({
		        url: `<?php echo base_url(); ?>api/cart/add`,
		        type: 'POST',
		        headers: {"Authorization": localStorage.getItem('Authorization')},
		        data : JSON.stringify(data),
		        contentTypev: 'application/json',
		        success: function(json_res) {
		        	if(json_res.status == 200){
		        		$(".cart_count").find('span').text(json_res.data.total_qty);
		        		$(".cart_price").text(json_res.data.total);
		        		window.location.href = `<?php echo base_url(); ?>product/detail?q=${JSON.stringify(q)}`;
		        	}
		        },error:function (xhr, ajaxOptions, thrownError){
		        	$(".cart_button").text("Out Of Stock");
		        	$(".cart_button").show();
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