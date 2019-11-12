

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Company</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">company</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12 col-xs-12">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('success'); ?>
            </div>
          <?php elseif($this->session->flashdata('error')): ?>
            <div class="alert alert-error alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <?php echo $this->session->flashdata('error'); ?>
            </div>
          <?php endif; ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Company Information</h3>
            </div>
            <form role="form" action="<?php base_url('company/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <span class="error-msg"><?php echo validation_errors(); ?></span>

                <div class="form-group">
                  <label for="company_name">Company Name</label>
                  <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter company name" value="<?php echo $company_data['company_name'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="company_name">GSTIN</label>
                  <input type="text" class="form-control" id="gstin" name="gstin" placeholder="Enter company GST number" value="<?php echo $company_data['gstin'] ?>" autocomplete="off">
                </div>
                <!--<div class="form-group">
                  <label for="service_charge_value">Charge Amount (%)</label>
                  <input type="text" class="form-control" id="service_charge_value" name="service_charge_value" placeholder="Enter charge amount %" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                </div>-->
                <div class="form-group">
                  <label for="vat_charge_value">GST Charge (%)</label>
                  <input type="text" class="form-control" id="vat_charge_value" name="vat_charge_value" placeholder="Enter vat charge %" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" value="<?php echo $company_data['address'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone" value="<?php echo $company_data['phone'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Enter country" value="<?php echo $company_data['country'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="state">State</label>
                  <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" value="<?php echo $company_data['state'] ?>" autocomplete="off">
                </div>
                 <div class="form-group">
                  <label for="message">Message</label><br>
                  <textarea class="form-control" id="message" name="message">
                     <?php echo $company_data['message'] ?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="permission">Company Logo</label><br>
                  <img src="<?php echo base_url();?>assets/images/<?php echo $company_data['logo'];?>" height="50px">
                  <input type="file" name="company_logo" id="company_logo">
                </div>
                <div class="form-group">
                  <label for="Sm-logo">Company Small Logo</label><br>
                  <img src="<?php echo base_url();?>assets/images/<?php echo $company_data['sm_logo'];?>" height="50px">
                  <input type="file" name="company_sm_logo" id="company_sm_logo">
                </div>
               <!-- <div class="form-group">
                  <label for="currency">Currency</label>
                  <?php ?>
                  <select class="form-control" id="currency" name="currency">
                    <option value="">~~SELECT~~</option>

                    <?php foreach ($currency_symbols as $k => $v): ?>
                      <option value="<?php echo trim($k); ?>" <?php if($company_data['currency'] == $k) {
                        echo "selected";
                      } ?>><?php echo $k ?></option>
                    <?php endforeach ?>
                  </select>
                </div>-->
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $("#companyNav").addClass('active');
    $("#message").wysihtml5();
  });
</script>

