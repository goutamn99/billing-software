<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Orders';

		$this->load->model('model_orders');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Orders';
		$this->render_template('orders/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_orders->countOrderItem($value['id']);
			$date = date('d-m-Y', strtotime($value['date_time']));
			$time = date('h:i a', strtotime($value['date_time']));

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('orders/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('orders/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$result['data'][$key] = array(
				$value['bill_no'],
				$value['customer_name'],
				$value['customer_phone'],
				$date_time,
				$count_total_item,
				$value['net_amount'],
				$value['profit'],
				$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$order_id = $this->model_orders->create();
        	
        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('orders/update/'.$order_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/create', $this->data);
        }	
	}

	public function escapeString($val) {
	    $db = get_instance()->db->conn_id;
	    $val = mysqli_real_escape_string($db, $val);
	    return $val;
	}

	public function manual()
	{

		$this->data['page_title'] = 'Manual Order';

		$this->form_validation->set_rules('product_name[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {      	
        	
        	//$order_id = $this->model_orders->create();
        	$invoice = $this->input->post('inv_no');
        	$bill_no = 'RLI/INV/'.date('Y').'-'.date('y', strtotime("+1 year")).'/0'.$invoice;
        	$order_date = date('d/m/Y');
        	$company_info = $this->model_company->getCompanyData(1);

        	$order_data = array(
        		'bill_no' => $bill_no,
        		'customer_name' => $this->input->post('customer_name'),
        		'customer_address' => $this->escapeString($this->input->post('customer_address')),
        		'customer_phone' => $this->input->post('customer_phone'),
        		'gross_amount' => $this->input->post('gross_amount_value'),
        		'vat_charge' => $this->input->post('vat_charge_value'),
        		'vat_charge_rate' => $company_info['vat_charge_value'],
        		'discount' => $this->input->post('discount'),
        		'net_amount' => $this->input->post('net_amount_value'),
        		);

					    	$html = '<!-- Main content -->
							<!DOCTYPE html>
							<html>
							<head>
							  <title>Invoice</title>
							  <!-- Bootstrap 3.3.7 -->
							  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
							  <!-- Font Awesome -->
							  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
							  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
							  <link rel="stylesheet" href="'.base_url('assets/dist/css/style.css').'">
							  <link rel="stylesheet"
				          href="https://fonts.googleapis.com/css?family=Tangerine">
				          <style>
				      body {
				        font-family: sans-serif;
				      }
				      h5{
				      	font-family: serif;
				      }
				      h4{
				      	font-family: serif;
				      }
				    </style>
							</head>
							<body onload="window.print();">
							
							<div class="">
							<div class="row">
								<div class="col-sm-12">
									<img src="'.base_url('assets/images/').$company_info['logo'].'" class="inv-image">
								</div>
							</div>
							  <section class="invoice">
							  	<div class="row">
							      <div class="col-xs-12">
							        <h5 align="center">
							        '.$company_info['address'].'<br>'.$company_info['state'].','.$company_info['country'].'
							        </h5>
							        <h5 align="center">
							        	<strong>GSTIN: '.$company_info['gstin'].'</strong>
							        </h5>
							      </div>
							      <!-- /.col -->
							    </div>
							    <!-- info row -->

							    <!-- title row -->
							     <div class="row">
							      <div class="col-xs-12">
							        <h4 align="center"><strong>
							          TAX INVOICE</strong>
							        </h4>
							      </div>
							      <!-- /.col -->
							    </div>
							    <!-- info row -->


							    <div class="row">
							      <div class="col-xs-12">
							        <h4>
							          <u>INVOICED TO:</u>
							          <small class="pull-right">INVOICE NO: '.$order_data['bill_no'].'</small><br/>
							          <small class="pull-right">INVOICE DATE: '.$order_date.'</small>
							        </h4>
							      </div>
							      <!-- /.col -->
							    </div>
							    <!-- info row -->
							    <div class="row invoice-info">
							      
							      <div class="col-sm-4 invoice-col">
							        
							        <b>'.$order_data['customer_name'].'</b><br>
							        <b>'.str_replace('\r\n','<br>', $order_data['customer_address']).' </b><br />
							        <b>'.$order_data['customer_phone'].'
							      </div>
							      <!-- /.col -->
							    </div>
							    <!-- /.row -->
							    <div style="padding:10px"></div>
							    <!-- Table row -->
							    <div class="row">
							      <div class="col-xs-12 table-responsive">
							        <table class="table table-bordered table-striped">
							          <thead>
							          <tr>
							          	<th>SL No.</th>
							            <th>Descripotion of Goods</th>
							            <th>Price</th>
							            <th>Qty</th>
							            <th>Amount</th>
							          </tr>
							          </thead>
							          <tbody>'; 
							          $i=1;
							          $count_product = count($this->input->post('product_name'));
							          for($j=0; $j<$count_product; $j++){
							          	$items = array(
								    			'name' => $this->input->post('product_name')[$j],
								    			'qty' => $this->input->post('qty')[$j],
								    			'rate' => $this->input->post('rate_value')[$j],
								    			'amount' => $this->input->post('amount_value')[$j],
								    		);

							          	$html .= '<tr>
							          		<td>'.$i++.'</td>
								            <td>'.$items['name'].'</td>
								            <td align="right">'.$items['rate'].'</td>
								            <td align="center">'.$items['qty'].'</td>
								            <td align="right">'.$items['amount'].'</td>
							          	</tr>';
							          }
							          
							          $html .= '<tr>
							          	<td colspan="4" align="right">Gross Amount:</td>
							          	<td align="right">'.$order_data['gross_amount'].'</td>
							          </tr>';
							          if($order_data['vat_charge'] > 0) {
							            	$html .= '
							          <tr>
							          	<td colspan="4" align="right">CGST '.($order_data['vat_charge_rate']/2).'%</td>
							          	<td align="right">'.($order_data['vat_charge']/2).'</td>
							          </tr>
							          <tr>
							          	<td colspan="4" align="right">SGST '.($order_data['vat_charge_rate']/2).'%</td>
							          	<td align="right">'.($order_data['vat_charge']/2).'</td>
							          </tr>';
							            }
							            if($order_data['discount'] > 0) {
							            $html .='
							            <tr>
							          	<td colspan="4" align="right">Discount:</td>
							          	<td align="right">'.$order_data['discount'].'</td>
							          </tr>';
							      }
							      $html .='
							          <tr>
							          	<td colspan="4" align="right"><strong>Net Payable Amount Rs.:</strong></td>
							          	<td align="right">'.$order_data['net_amount'].'<br> Round Off : <strong>'.round($order_data['net_amount']).'</strong></td>
							          </tr>
							          <tr>
							          	<td colspan="5" align="right"><strong>'.$this->getIndianCurrency(round($order_data['net_amount'])).'</strong></td>
							          </tr>
							          </tbody>
							        </table>
							      </div>
							      <!-- /.col -->
							    </div>
							    <!-- /.row -->

							    <div class="row">
							      
							      <div class="col-xs-12">
							      	'.$company_info['message'].'
							      </div>
							   </div>
							  </section>
							  <!-- /.content -->
							</div>
						</body>
					</html>';

			  echo $html;
	    	
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/manual_order', $this->data);
        }	
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	public function getProductValueBySKU()
	{
		$product_sku = $this->input->post('product_sku');
		if($product_sku) {
			$product_data = $this->model_products->getProductDataBySKU($product_sku);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_orders->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('orders/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$orders_data = $this->model_orders->getOrdersData($id);

    		$result['order'] = $orders_data;
    		$orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['order_item'][] = $v;
    		}

    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_orders->remove($order_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

		//Convert rupees to word

			function getIndianCurrency($number)
			{
			    $decimal = round($number - ($no = floor($number)), 2) * 100;
			    $hundred = null;
			    $digits_length = strlen($no);
			    $i = 0;
			    $str = array();
			    $words = array(0 => '', 1 => 'One', 2 => 'Two',
			        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
			        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
			        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
			        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
			        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
			        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
			        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
			        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
			    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
			    while( $i < $digits_length ) {
			        $divider = ($i == 2) ? 10 : 100;
			        $number = floor($no % $divider);
			        $no = floor($no / $divider);
			        $i += $divider == 10 ? 1 : 2;
			        if ($number) {
			            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			            $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
			            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
			        } else $str[] = null;
			    }
			    $Rupees = implode('', array_reverse($str));
			    $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
			    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
			}
	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/
	public function printDiv($id)
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', strtotime($order_data['date_time']));
			$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

			$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<head>
			  <title>Invoice</title>
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/style.css').'">
			  <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
          <style>
      body {
        font-family: sans-serif;
      }
      h5{
      	font-family: serif;
      }
      h4{
      	font-family: serif;
      }
      .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
      	padding:5px !important;
      }
    </style>
			</head>
			<body onload="window.print();">
			
			<div class="">
			<div class="row">
				<div class="col-sm-12">
					<img src="'.base_url('assets/images/').$company_info['logo'].'" class="inv-image">
				</div>
			</div>
			  <section class="invoice">
			  	<div class="row">
			      <div class="col-xs-12">
			        <h5 align="center">
			        '.$company_info['address'].'<br>'.$company_info['state'].','.$company_info['country'].'
			        </h5>
			        <h5 align="center">
			        	<strong>GSTIN: '.$company_info['gstin'].'</strong>
			        </h5>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->

			    <!-- title row -->
			     <div class="row">
			      <div class="col-xs-12">
			        <h4 align="center"><strong>
			          TAX INVOICE</strong>
			        </h4>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->


			    <div class="row">
			      <div class="col-xs-12">
			        <h4>
			          <u>INVOICED TO:</u>
			          <small class="pull-right">INVOICE NO: '.$order_data['bill_no'].'</small><br/>
			          <small class="pull-right">INVOICE DATE: '.$order_date.'</small>
			        </h4>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <div class="col-sm-4 invoice-col">
			        
			        <b>'.$order_data['customer_name'].'</b><br>
			        <b>'.$order_data['customer_address'].' </b><br />
			        <b>'.$order_data['customer_phone'].'
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->
			    <div style="padding:10px"></div>
			    <!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-bordered table-striped">
			          <thead>
			          <tr>
			          	<th>SL No.</th>
			            <th>Descripotion of Goods</th>
			            <th>Price</th>
			            <th>Qty</th>
			            <th>Amount</th>
			          </tr>
			          </thead>
			          <tbody>'; 
			          $i=1;
			          foreach ($orders_items as $k => $v) {
			          	$product_data = $this->model_products->getProductData($v['product_id']); 
			          	$brand=get_perticular_field_value('brands','name'," and id='".$product_data['brand_id']."'");
			          	$html .= '<tr>
			          		<td>'.$i++.'</td>
				            <td>'.$product_data['name'].'&nbsp; &nbsp; &nbsp;'.$brand.'</td>
				            <td align="right">'.$v['rate'].'</td>
				            <td align="center">'.$v['qty'].'</td>
				            <td align="right">'.$v['amount'].'</td>
			          	</tr>';
			          }
			          
			         /* $html .= '<tr>
			          	<td colspan="4" align="right">Gross Amount:</td>
			          	<td align="right">'.$order_data['gross_amount'].'</td>
			          </tr>';*/
			          if($order_data['vat_charge'] > 0) {
			            	$html .= '
			          <tr>
			          	<td colspan="4" align="right">CGST '.($order_data['vat_charge_rate']/2).'%</td>
			          	<td align="right">'.($order_data['vat_charge']/2).'</td>
			          </tr>
			          <tr>
			          	<td colspan="4" align="right">SGST '.($order_data['vat_charge_rate']/2).'%</td>
			          	<td align="right">'.($order_data['vat_charge']/2).'</td>
			          </tr>';
			            }
			            if($order_data['discount'] > 0) {
			            $html .='
			            <tr>
			          	<td colspan="4" align="right">Discount:</td>
			          	<td align="right">'.$order_data['discount'].'</td>
			          </tr>';
			      }
			      $html .='
			          <tr>
			          	<td colspan="4" align="right">Total Amount Rs.:</td>
			          	<td align="right">'.$order_data['net_amount'].'</strong></td>
			          </tr>
			          <tr>
			          	<td colspan="4" align="right">Less Round Off.:</td>
			          	<td align="right">'.$order_data['less_amount'].'</strong></td>
			          </tr>
			          <tr>
			          	<td colspan="4" align="right"><strong>Net Payble Amount Rs.:</strong></td>
			          	<td align="right"><strong>'.$order_data['payble_amount'].'</strong></td>
			          </tr>
			          <tr>
			          <td colspan="5" align="right"><strong>'.$this->getIndianCurrency(round($order_data['payble_amount'])).'</strong></td>
					  </tr>
			          </tbody>
			        </table>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- /.row -->

			    <div class="row">
			      
			      <div class="col-xs-12">
			      	'.$company_info['message'].'
			      </div>
			   </div>
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

			  echo $html;
		}
	}

}