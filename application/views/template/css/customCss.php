<style type="text/css">
	.filter_subtitle{
		text-transform: capitalize;
		color: black;
	}
	.filter_value{
		text-transform: capitalize;
		color: grey;
	}
	.cat_menu{
		text-transform: capitalize;
	}
	.sidebar_categories{
		text-transform: capitalize;
	}
	.product_name{
		text-transform: capitalize;
		margin: 0px 11px;
	}
	.product_image img{
		display: block;
	    position: relative;
	    max-width: 60%;
	}
	.product_text{
		text-transform: capitalize;
	}
	.cart_item_text{
		text-transform: capitalize;
	}
	.error{
		color: red;
	}
	.username{
		text-transform: capitalize;
	}
	.popular_category_text{
		text-transform: capitalize;
	}
	.modal-title{
		color: white;
	}
	.modal-content{
		background: url("<?php echo base_url("assets/layout/images/login-banner.jpg"); ?>");
		background-repeat: no-repeat;
		background-position: center;
		background-size: cover;
	}
	.modal-user-link{
		color: yellow;
		font-weight: bold;
	}
	.modal-user-link:hover{
		color: rgba(255,255,0,0.9);
		font-weight: bold;
	}
	.banner-logo{
		border-radius: 50% 50%;
		width: 10%;
	}
	.advert_image img {
	    display: block;
	    max-width: 85%;
	}
	.advert_title_2 a {
	    font-size: 12px;
	    font-weight: 500;
	    color: #0e8ce4;
	}
	.advert_text {
	    color: #828282;
	    margin-top: 10px;
	    font-size: 13px;
	}
	.advert_subtitle {
	    font-size: 12px;
	    font-weight: bold;
	    color: rgba(0,0,0,0.5);
	    margin-bottom: 26px;
	    color: black;
	}
	.error p{
		color: red;
	}
	.top_bar_icon{
		width: 15%;
	}
	.top_bar_contact_item{
		color: #e40e36;
		font-weight: 500;
	}
	.top_bar_icon img{
		border-radius: 50%;
		width: 100%;
	}
	.brands_item img{
		border-radius: 50%;
	}
	.cat_menu li a{
		overflow: hidden;
	}

</style>

<script type="text/javascript">
		var q = '<?php echo $this->input->get("q"); ?>';
		if(q != ''){
			q = JSON.parse(q);
		}else{
			q = {};
		}
</script>