	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content">
Copyright &copy; by <a href="http://vdsai.com" target="_blank">VDAI BIO SEC Pvt Ltd.</a> <?php echo date("Y"); ?>. All rights reserved.

</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="<?php echo base_url("assets/layout"); ?>/images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="<?php echo base_url("assets/layout"); ?>/images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="<?php echo base_url("assets/layout"); ?>/images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="<?php echo base_url("assets/layout"); ?>/images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php foreach($js as $row): $this->load->view($row); endforeach; ?>
</body>

</html>