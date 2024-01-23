 <!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo PROJECT_NAME; ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Kanpur Needs">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<?php foreach($css as $row): $this->load->view($row); endforeach; ?>

</head>

<body>

<div class="super_container">

	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo base_url("assets/layout/images/kanpur-nagar-nigam.gif"); ?>" alt=""></div>Initiative by Kanpur Nagar Nigam</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="<?php echo base_url("assets/layout/images/clc-logo.png"); ?>" alt=""></div>Managed by CLC</div>
						<div class="top_bar_content ml-auto">
							<!-- <div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<a href="#">English<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">Italian</a></li>
											<li><a href="#">Spanish</a></li>
											<li><a href="#">Japanese</a></li>
										</ul>
									</li>
									<li>
										<a href="#">$ US dollar<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="#">EUR Euro</a></li>
											<li><a href="#">GBP British Pound</a></li>
											<li><a href="#">JPY Japanese Yen</a></li>
										</ul>
									</li>
								</ul>
							</div> -->
							<div class="top_bar_user">
								<div class="user_icon"><img src="<?php echo base_url("assets/layout"); ?>/images/user.svg" alt=""></div>
								<div><a href="#" class="username"></a></div>
								<div><a href="#" class="logout">Logout</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-4 col-sm-3 col-8 order-1">
						<div class="logo_container">
							<div class="logo"><a class="text-danger" href='<?php echo base_url(); ?>home?q=<?php echo $this->input->get('q');?>'><?php echo PROJECT_NAME; ?></a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="#" class="header_search_form clearfix">
										<input type="search" required="required" class="header_search_input" placeholder="Search for products...">
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<!-- <ul class="custom_list clc">
													<li><a class="clc" href="#">All Categories</a></li>
													<li><a class="clc" href="#">Computers</a></li>
													<li><a class="clc" href="#">Laptops</a></li>
													<li><a class="clc" href="#">Cameras</a></li>
													<li><a class="clc" href="#">Hardware</a></li>
													<li><a class="clc" href="#">Smartphones</a></li>
												</ul> -->
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300 bg-danger" value="Submit"><img src="<?php echo base_url("assets/layout"); ?>/images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					<div class="col-lg-2 col-4 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<!-- <div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="<?php //echo base_url("assets/layout"); ?>/images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="#">Wishlist</a></div>
									<div class="wishlist_count">115</div>
								</div>
							</div> -->

							<!-- Cart -->
							<div class="cart">
								<a href="<?php echo base_url(); ?>cart/view">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
											<img src="<?php echo base_url("assets/layout"); ?>/images/cart.png" alt="">
										</a>
										<div class="cart_count bg-danger"><span></span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="<?php echo base_url(); ?>cart/view">Cart</a></div>
										<div class="cart_price"></div>
									</div>
								</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Main Navigation -->

		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">

						<style type="text/css">
							@media only screen and (max-width: 991px){
								.main_nav_content {
								    background: #dc3545!important;
								}
							}

						</style>
						
						<div class="main_nav_content d-flex flex-row">

							<!-- Categories Menu -->

							<div class="cat_menu_container bg-danger">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">categories</div>
								</div>

								<ul class="cat_menu">
									
								</ul>
							</div>

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href='<?php echo base_url(); ?>home?q=<?php echo $this->input->get('q');?>'>Home<i class="fas fa-chevron-down"></i></a></li>
									<li><a href='<?php echo base_url(); ?>home?q=<?php echo $this->input->get('q');?>'>Order History<i class="fas fa-chevron-down"></i></a></li>
									<li><a href='<?php echo base_url(); ?>policy/term?q=<?php echo $this->input->get('q');?>'>Term Of Use<i class="fas fa-chevron-down"></i></a></li>
									<li><a href='<?php echo base_url(); ?>policy/privacy?q=<?php echo $this->input->get('q');?>'>Privacy<i class="fas fa-chevron-down"></i></a></li>
									<!-- <li class="hassubs">
										<a href="#">Super Deals<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="#">Menu Item<i class="fas fa-chevron-down"></i></a>
												<ul>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
												</ul>
											</li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="#">Featured Brands<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="#">Menu Item<i class="fas fa-chevron-down"></i></a>
												<ul>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
													<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
												</ul>
											</li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="#">Menu Item<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="#">Pages<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="shop.html">Shop<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="product.html">Product<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="blog.html">Blog<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="blog_single.html">Blog Post<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="regular.html">Regular Post<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="cart.html">Cart<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="contact.html">Contact<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li><a href="blog.html">Blog<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="contact.html">Contact<i class="fas fa-chevron-down"></i></a></li> -->
								</ul>
							</div>

							<!-- Menu Trigger -->

							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</nav>
		
		<!-- Menu -->

		<div class="page_menu">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="page_menu_content">
							
							<div class="page_menu_search">
								<form action="#">
									<input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
								</form>
							</div>
							<ul class="page_menu_nav">
								<li class="page_menu_item"><a href="<?php echo base_url(); ?>home">Home<i class="fas fa-angle-down"></i></a></li>
									<li class="page_menu_item"><a href="<?php echo base_url(); ?>home">Order History<i class="fas fa-angle-down"></i></a></li>
									<li class="page_menu_item"><a href="<?php echo base_url(); ?>policy/term">Term Of Use<i class="fas fa-angle-down"></i></a></li>
									<li class="page_menu_item"><a href="<?php echo base_url(); ?>policy/privacy">Privacy<i class="fas fa-angle-down"></i></a></li>
									<li class="page_menu_item"><a href="#" class="logout">Logout</a></li>

							</ul>
							
							<div class="menu_contact">

								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="<?php echo base_url("assets/layout"); ?>/images/phone_white.png" alt=""></div><?php echo ADMIN_MOBILE; ?></div>
								<div class="menu_contact_item"><div class="menu_contact_icon"><img src="<?php echo base_url("assets/layout"); ?>/images/mail_white.png" alt=""></div><a href="mailto:<?php echo ADMIN_MAIL; ?>"><?php echo ADMIN_MAIL; ?></a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header>