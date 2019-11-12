<?php
$company_info=getCompanyData();
?>
<header class="main-header">
<style type="text/css">
  li.logout{
    padding: 10px;
    font-size: 20px;
    color: #fff;
}
</style>
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo base_url('assets/images/').$company_info->sm_logo; ?>" height="40px"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo base_url('assets/images/').$company_info->logo; ?>" height="30px"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <a href="<?php echo base_url();?>auth/logout"><li class="logout"><i class="fa fa-power-off"></i></li></a>
      </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  