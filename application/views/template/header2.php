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
								<div class="user_icon"></div>
								<div><a href="#" class="username"><?php echo ADMIN_MAIL; ?></a></div>
								<div><a href="#" class="logout"><?php echo ADMIN_MOBILE; ?></a></div>
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
							<div class="logo"><a href="<?php echo base_url(); ?>home"><?php echo PROJECT_NAME; ?></a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									
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
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
											<img src="<?php echo base_url("assets/layout/images/clc-logo.png"); ?>" style="border-radius: 50%" alt="">
										</a>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="#"></a></div>
										<div class="cart_price"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		


	</header>