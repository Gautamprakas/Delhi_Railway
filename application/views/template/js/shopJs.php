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
<script src="<?php echo base_url("assets/layout"); ?>/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/parallax-js-master/parallax.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/js/shop_custom.js"></script>

<?php $this->load->view("template/js/ajaxJs"); ?>

<script type="text/javascript">
	$(document).ready(function(){
		$.loginModal();
		$.signupModal();
		$.setCart();
		$.setCategories(q);
		$.setFilter(q);
		$.setProductList(q);
		$.setSorting(q);

		$(".shop_sorting").on('click','.shop_sorting_button',function(){
			$(".sorting_text").text($(this).text());
			q.sort = $(this).attr("data-value");
			q.pg = 0;
			window.location.href = `<?php echo base_url(); ?>product/list?q=${JSON.stringify(q)}`;
		});

		$(".shop_page_nav").on('click','.page_prev',function(){
			q.pg -= 1;
			window.location.href = `<?php echo base_url(); ?>product/list?q=${JSON.stringify(q)}`;
		});

		$(".shop_page_nav").on('click','.page_next',function(){
			q.pg += 1;
			window.location.href = `<?php echo base_url(); ?>product/list?q=${JSON.stringify(q)}`;
		});

		$(".shop_sidebar").on('change','input:checkbox',function() {
		    var ischecked= $(this).is(':checked');
		    var name = $(this).attr("data-name");
		    var value = $(this).attr("data-value");
		    if(!ischecked){
		    	if(typeof q.filter[name] !== 'undefined'){
					var index = q.filter[name].indexOf(value);
					if(  index > -1 ){
						q.filter[name].splice(index,1);
						if(q.filter[name].length <= 0){
							delete q.filter[name];
						}
					}
					
				}
		    }else{
		    	if(typeof q.filter != 'undefined'){
		    		if(typeof q.filter[name] == 'undefined'){
						q.filter[name] = Array(value);
					}else{
						q.filter[name].push(value);
					}
		    	}else{
		    		q.filter = {[name]:Array(value)};
		    	}
		    }
		    q.pg = 0;
		    window.location.href = `<?php echo base_url(); ?>product/list?q=${JSON.stringify(q)}`;
		});



	});
</script>