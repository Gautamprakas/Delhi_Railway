<?php
	header("Cache-Control: max-age=2592000");
	include('move_to_top.php');
?>

<html lang="en">
<head>
	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="Sweet-alert/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="Sweet-alert/dist/sweetalert2.css">  
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css'>

	<style type="text/css">
		/* #swal2-content::-webkit-scrollbar{width: 0 !important} */
		.heading1{
			font-size: 21px;
			text-transform: uppercase;
			letter-spacing: 2px;
		}
    	.page::-webkit-scrollbar{
    		width: 0 !important
    	}
		.bold{
			font-weight: bold;
		}
		#swal2-header{
			margin-top: 1%;
		}
		#swal2-content,body{
			/* overflow: scroll; */
			text-align: center;
			align-self: center;
			width: 100%;
			background-image: url('images/swal_bg4.jpg');
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.swal-wide{
			/* overflow: scroll; */
			width: 60%
		}
		.table_property{
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;overflow: scroll;
		}
		.table_property td, .table_property th {
			border: 1px solid #ddd;
			padding: 8px;
			font-weight: bold;
		}
		.table_property th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: center;
		}
		.example-1{
			animation: pulse 2s infinite;
		}
		@keyframes pulse {
			0% {
				transform: scale(1.02);
				box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
			}
			70% {
				transform: scale(1);
				box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
			}
			100% {
				transform: scale(1.02);
				box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
			}
		}
		.pointer {
			cursor: pointer;
		}
		@import url(https://fonts.googleapis.com/css?family=PT+Sans+Narrow);
		* {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		.sectionClass {
			padding: 20px 0px 50px 0px;
			position: relative;
			display: block;
		}
		.sectiontitle {
			background-position: center;
			margin: 30px 0 0px;
			text-align: center;
			min-height: 20px;
		}
		.sectiontitle h2 {
			font-size: 30px;
			color: #222;
			margin-bottom: 0px;
			padding-right: 10px;
			padding-left: 10px;
		}
		.headerLine {
			width: 160px;
			height: 2px;
			display: inline-block;
			background: #101F2E;
		}
		.projectFactsWrap{
			text-align: center;
		}
		.projectFactsWrap .item p.number{
			font-size: 50px;
			font-weight: bold;
			text-shadow: 2px 2px 8px #000000;
		}
		.btn{
			background-color: #154360;
			color: white
		}
		.polaroid{
			box-shadow: 0 20px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}
		.polaroid_div{
			box-shadow: 0 2.2px 2.2px 0 rgba(0, 0, 0, 0.2), 0 6px 10px 0 rgba(0, 0, 0, 0.19);
		}
		.polaroid_link:hover:before {
			transform: scale(1.2);
			box-shadow: 0 0 15px #d35400;
			filter: blur(3px);
		}
		.polaroid_link:hover {
			color: #ffa502;
			box-shadow: 0 0 15px #d35400;
			text-shadow: 0 0 15px #d35400;
		}
		.polaroid_link:before {
			transition: .5s;
			transform: scale(.9);
			z-index: -1;
		}
		.polaroid_link{
			box-shadow: 0 10px 8px 0 rgba(0, 0, 0, 0.8), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			transition: .5s;
			border-radius: 50%;
			border:solid 2px black;
		}
		.polaroid_link_cat:hover:before {
			transform: scale(1.2);
			box-shadow: 0 0 15px #d35400;
			filter: blur(3px);
		}
		.polaroid_link_cat:hover {
			color: #ffa502;
			box-shadow: 0 0 15px #d35400;
			text-shadow: 0 0 15px #d35400;
		}
		.polaroid_link_cat:before {
			transition: .5s;
			transform: scale(.9);
			z-index: -1;
		}
		.polaroid_link_cat{
			transition: .5s;
		}
		.projectFactsWrap .item i{
			vertical-align: middle;
			font-size: 50px;
			text-shadow: 2px 2px 8px #000000;
		}
		.footer_font{
			color: #F9E79F;
			font-size: 15px;
			font-weight: bold;
		}
	</style>

	<title>Trace4Security Report</title>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" class="" >
	<div class='preloader'><div class='loaded'>&nbsp;</div></div>
	<div class="site-wrap" id="home-section">
		<div class="site-mobile-menu site-navbar-target">
			<div class="site-mobile-menu-header">
				<div class="site-mobile-menu-close mt-3">
					<span class="icon-close2 js-menu-toggle"></span>
				</div>
			</div>
			<div class="site-mobile-menu-body"></div>
		</div>
	</div>

	<?php //include('header.php');?>

	<!-- <div class="sectiontitle" style="margin-bottom: 2%;margin-top: 12%">
	<h2>RBSK Report</h2>
	<span class="headerLine"></span>
	</div> -->
	<?php include('division_map.php');?>
	


	<?php //include('footer.php');?>

	<script src="js/jquery/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/main.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script type="text/javascript">
		$(window).load(function() {
			$(".preloader").fadeOut("slow");
		});
	</script>	
	<script src="Sweet-alert/dist/sweetalert2.min.js"></script>
	<script src="Sweet-alert/dist/sweetalert2.js"></script>
	<script>
		var category_array = ["screened","refer","under_process","complete"];
		var color_array = ["blue","yellow","orange","green"];		
		
		$("document").ready(function(){

			$.ajax({
				type: "POST",
				async: true,
				data: { func_name : "getSkills"},
				url: "controller.php",
				success: function (result) {
					result = JSON.parse(result);
					var options = `<option value="">Select Skill</option>`;
					$.each(result,function (index,row){
						options += `<option value="${row.skill}">${row.skill}</option>`
					});
					$("body").find("#skill").html(options);
				}
			});

			$.ajax({
				type: "POST",
				async: true,
				data: { func_name : "getDistrictReport"},
				url: "controller.php",
				success: function (result) {
					result = JSON.parse(result);
					$.fn.generateDistrictTable(result);
				}
			});

			$("body").on("change","#skill",function(){
				$.ajax({
					type: "POST",
					async: true,
					data: { func_name : "getExperience", skill : $("#skill").val() },
					url: "controller.php",
					success: function (result) {
						result = JSON.parse(result);
						var options = `<option value="">Select Experience</option>`;
						$.each(result,function (index,row){
							options += `<option value="${row.experience}">${row.experience}</option>`
						});
						$("body").find("#experience").html(options);
					}
				});
			});	


			$("#form").submit(function(e){
				e.preventDefault();
				$("#g3361").find( ".map" ).css( "fill", "" );
				
				$("#g3361").find( ".map" ).off('click');
				$("#g3361").find( ".map" ).removeClass("example-1");
				$("#g3361").find( ".map" ).removeClass("pointer");
				$("#g3361").find( ".map" ).removeAttr("data-district");
				

				skill = $("#skill").val();
				experience = $("#experience").val();
				gender = $("#gender").val();
				$("#getMap").text("Please Wait..");
				$("#getMap").attr("disabled",true);
				$.ajax({
					type: "POST",
					async: true,
					data: { func_name : "getDistrictReport" , skill : skill, experience : experience, gender : gender },
					url: "controller.php",
					success: function (result) {
						result = JSON.parse(result);
						$.fn.generateDistrictTable(result);
						$("#getMap").text("Get Report");
						$("#getMap").attr("disabled",false);
					}
				});
			});



			$.fn.generateDistrictTable = function(result){
				tbody = ``;
				$.each(result,function (index,row){
					tbody += `
						<tr>
							<td style="color:${row['color']};background:#F9E79F;border-color:#1c2d37;text-transform:capitalize;" >${row["district"]}</td>
							<td>${row["below 15"]}</td>
							<td>${row["15-24"]}</td>
							<td>${row["25-54"]}</td>
							<td>${row["55-64"]}</td>
							<td>${row["above 64"]}</td>
						</tr>
					`;
					$(row["path_id"]).css("fill",row["color"]);
					$(row["path_id"]).hover(function(){$(this).css('opacity',0.8);},function(){$(this).css('opacity',1);});
					$(row["path_id"]).addClass("example-1");
					$(row["path_id"]).addClass("pointer");
					$(row["path_id"]).attr("data-district",row["district"]);
				});
				$("#dynamicTable").find("tbody").html(tbody);
				$("#dynamicTable").css("display",'block');
			}

			$("#g3361").on("click",".pointer",function(){
				district = $(this).attr("data-district");
				skill = $("#skill").val();
				experience = $("#experience").val();
				gender = $("gender").val();
				$.ajax({
					type: "POST",
					async: true,
					data: { func_name : "getBlockReport" ,district : district , skill : skill, experience : experience, gender : gender },
					url: "controller.php",
					success: function (result) {
						result = JSON.parse(result);
						$.fn.generateBlockTable(result,district);
					}
				});

			});

			$.fn.generateBlockTable = function(result,district){
				table = `
					 <table class="table_property" style="width:100%;font-size:15px;">
				    <caption style="font-size:20px;color:#1c2d37;font-weight:bold;caption-side:top;text-transform:capitalize;text-align:center">${district}</caption>
				    <thead style="background-color:#1c2d37;color: #F9E79F;">
				      <tr>
				        <th>Block</th>
				        <th>Age (Below 15)</th>
				        <th>Age (15-24)</th>
				        <th>Age (25-54)</th>
				        <th>Age (55-64)</th>
				        <th>Age (Above 64)</th>
				      </tr>
				    </thead>
				    <tbody>
				`;
				$.each(result,function (index,row){
					table += `
						<tr>
							<td style='text-transform:capitalize;'>${row["block"]}</td>
							<td>${row["below 15"]}</td>
							<td>${row["15-24"]}</td>
							<td>${row["25-54"]}</td>
							<td>${row["55-64"]}</td>
							<td>${row["above 64"]}</td>
						</tr>
					`;
				});
				table += `
					</tbody>
					</table>
				`;

				Swal.fire({
					html : table,
					showCloseButton: true,
					customClass: 'swal-wide',
					focusConfirm: false,
					confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
					confirmButtonAriaLabel: 'Thumbs up, great!',
				});
			}



			
		});

		
	</script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</body>
</html>