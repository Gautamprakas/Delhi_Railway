<?php
$this->load->view("view/include/header",["headerCss"=>$headerCss]);
$this->load->view("view/include/menu",["menuActive"=>$menuActive,"subMenuActive"=>$subMenuActive]);
$this->load->view("view/include/footer",["mainContent"=>$mainContent,
                                          "footerJs"=>$footerJs]
                  );
?>