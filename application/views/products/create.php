

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Products</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Products</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

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
            <h3 class="box-title">Add Product</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('users/create') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">

                <span class="error-msg"><?php //echo validation_errors(); ?></span>

                <div class="form-group">

                  <label for="product_image">Image</label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="product_name">Product name</label>
                  <span class="error-msg"><?php echo form_error('product_name'); ?></span>
                  <input type="text" class="form-control" id="product_name" value="<?php echo set_value('product_name'); ?>" name="product_name" placeholder="Enter product name" autocomplete="off"/>
                </div>

                <div class="form-group">
                  <label for="sku">SKU</label>
                  <span class="error-msg"><?php echo form_error('sku'); ?></span>
                  <input type="text" class="form-control" id="sku" name="sku" value="<?php echo set_value('sku'); ?>" placeholder="Enter sku" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="Cost price">Cost Price</label>
                  <span class="error-msg"><?php echo form_error('cost_price'); ?></span>
                  <input type="text" class="form-control" id="cost_price" name="cost_price" value="<?php echo set_value('cost_price'); ?>" placeholder="Enter Cost Price" autocomplete="off" />
                </div>

                <!--<div class="form-group">
                  <label for="price">Selling Price</label>
                  <span class="error-msg"><?php echo form_error('price'); ?></span>
                  <input type="text" class="form-control" id="price" name="price" value="<?php echo set_value('price'); ?>" placeholder="Enter Selling Price" autocomplete="off" />
                </div>-->

                <div class="form-group">
                  <label for="qty">Qty</label>
                  <span class="error-msg"><?php echo form_error('qty'); ?></span>
                  <input type="text" class="form-control" id="qty" name="qty" value="<?php echo set_value('qty'); ?>" placeholder="Enter Qty" autocomplete="off" />
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <span class="error-msg"><?php echo form_error('description'); ?></span>
                  <textarea type="text" class="form-control" id="description" value="<?php echo set_value('description'); ?>" name="description" placeholder="Enter 
                  description" autocomplete="off">
                  </textarea>
                </div>

                <?php if($attributes): ?>
                  <?php foreach ($attributes as $k => $v): ?>
                    <div class="form-group">
                      <label for="groups"><?php echo $v['attribute_data']['name'] ?></label>
                      <select class="form-control select_group" id="attributes_value_id" name="attributes_value_id[]" multiple="multiple">
                        <?php foreach ($v['attribute_value'] as $k2 => $v2): ?>
                          <option value="<?php echo $v2['id'] ?>"><?php echo $v2['value'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>    
                  <?php endforeach ?>
                <?php endif; ?>

                <div class="form-group">
                  <label for="brands">Brands</label>
                  <span class="error-msg"><?php echo form_error('brands'); ?></span>
                  <!--<select class="form-control select_group" id="brands" name="brands[]" multiple="multiple">
                    <?php foreach ($brands as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>-->

                  <input name="brands" class="form-control" list="brand">
                  <datalist id="brand">
                  <?php foreach ($brands as $k => $v): ?>
                    <option value="<?php echo $v['name'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </datalist>

                </div>
                

                <div class="form-group">
                  <label for="category">Category</label>
                  <span class="error-msg"><?php echo form_error('category'); ?></span>
                  <!--<select class="form-control select_group" id="category" name="category[]" multiple="multiple">
                    <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>-->

                  <input name="category" class="form-control" list="categorys">
                  <datalist id="categorys">
                  <?php foreach ($category as $k => $v): ?>
                    <option value="<?php echo $v['name'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </datalist>
                </div>

                <div class="form-group">
                  <label for="store">Store</label>
                  <span class="error-msg"><?php echo form_error('store'); ?></span>
                  <select class="form-control select_group" id="store" name="store">
                    <?php foreach ($stores as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="store">Availability</label>
                  <span class="error-msg"><?php echo form_error('availability'); ?></span>
                  <select class="form-control" id="availability" name="availability">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="<?php echo base_url('products/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->
    
    <!-- Modal for add new brand-->
                  <div class="modal fade" id="myModal_brand" role="dialog">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Add Brand</h4>
                        </div>
                        <form action="<?php echo base_url('brands/create') ?>" method="post" id="createBrandForm">

                              <div class="modal-body">

                                <div class="form-group">
                                  <label for="brand_name">Brand Name</label>
                                  <input type="hidden" name="url" value="1">
                                  <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Enter brand name" autocomplete="off">
                                </div>
                                <div class="form-group">
                                  <label for="active">Status</label>
                                  <select class="form-control" id="active" name="active">
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                  </select>
                                </div>
                              </div>

                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>

                            </form>
                      </div>
                    </div>
                  </div>

                  <!-- create brand modal -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="addModal_cat">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Add Category</h4>
                        </div>

                        <form role="form" action="<?php echo base_url('category/create') ?>" method="post" id="createForm">

                          <div class="modal-body">

                            <div class="form-group">
                              <label for="brand_name">Category Name</label>
                              <input type="hidden" name="url" value="1">
                              <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" autocomplete="off">
                            </div>
                            <div class="form-group">
                              <label for="active">Status</label>
                              <select class="form-control" id="active" name="active">
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                              </select>
                            </div>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>

                        </form>


                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                  </div><!-- /.modal -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#addProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
      //  layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>