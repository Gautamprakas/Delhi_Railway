<script src="<?php echo base_url("assets/layout"); ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/styles/bootstrap4/popper.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/slick-1.8.0/slick.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/plugins/easing/easing.js"></script>
<script src="<?php echo base_url("assets/layout"); ?>/js/custom.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<?php $this->load->view("template/js/ajaxJs"); ?>

<script type="text/javascript">
	$(document).ready(function(){
		$.loginModal();
		$.signupModal();
		$.setCart();
		
		$.setCategories(q);
		$.setAdverts(q);

		$.setLocation(q);
		$.setProdtype(q);

		$(".location").on('change',function(){

			let key =$(this).attr('name');
			if($(this).val().length>0){
				if(typeof q.filter == 'undefined'){
					q.filter =  {[key]:$(this).val()};
				}else{
					q.filter[key] =  $(this).val();
				}
				
			}else{
				delete q.filter[key];
			}

			window.location.href = `${window.location.origin}${window.location.pathname}?q=${JSON.stringify(q)}`;
		});


		$(".prodtype").on('change',function(){
			let key =$(this).attr('name');
			if($(this).val().length>0){
				if(typeof q.filter == 'undefined'){
					q.filter =  {[key]:Array($(this).val())};
				}else{
					q.filter[key] =  Array($(this).val());
				}
			}else{
				delete q.filter[key];
			}

			window.location.href = `${window.location.origin}${window.location.pathname}?q=${JSON.stringify(q)}`;
		});


		
	});
</script>