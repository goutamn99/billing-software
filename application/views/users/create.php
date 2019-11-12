

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage
        <small>Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
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
              <h3 class="box-title">Add User</h3>
            </div>
            <form role="form" action="<?php base_url('users/create') ?>" method="post">
              <div class="box-body">

                <?php //echo validation_errors(); ?>

                <div class="form-group">
                  <label for="groups">Groups</label>
                  <select class="form-control" id="groups" name="groups">
                    <option value="">Select Groups</option>
                    <?php foreach ($group_data as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="username">Username</label>
                  <span class="error-msg"><?php echo form_error('username'); ?></span>
                  <input type="text" class="form-control" id="username" value="<?php echo set_value('username'); ?>" name="username" placeholder="Username" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <span class="error-msg"><?php echo form_error('email'); ?></span>
                  <input type="email" class="form-control" id="email" value="<?php echo set_value('email'); ?>" name="email" placeholder="Email" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <span class="error-msg"><?php echo form_error('password'); ?></span>
                  <input type="text" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="cpassword">Confirm password</label>
                  <span class="error-msg"><?php echo form_error('cpassword'); ?></span>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="fname">First name</label>
                  <span class="error-msg"><?php echo form_error('fname'); ?></span>
                  <input type="text" class="form-control" id="fname" value="<?php echo set_value('fname'); ?>" name="fname" placeholder="First name" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="lname">Last name</label>
                  <span class="error-msg"><?php echo form_error('lname'); ?></span>
                  <input type="text" class="form-control" id="lname" name="lname" value="<?php echo set_value('lname'); ?>" placeholder="Last name" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="phone">Phone</label>
                  <span class="error-msg"><?php echo form_error('phone'); ?></span>
                  <input type="text" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone'); ?>" placeholder="Phone" autocomplete="off">
                </div>

                <div class="form-group">
                  <label for="gender">Gender</label>
                  <span class="error-msg"><?php echo form_error('gender'); ?></span>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="male" value="1">
                      Male
                    </label>
                    <label>
                      <input type="radio" name="gender" id="female" value="2">
                      Female
                    </label>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('users/') ?>" class="btn btn-warning">Back</a>
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
    $("#groups").select2();

    $("#mainUserNav").addClass('active');
    $("#createUserNav").addClass('active');
  
  });
</script>
