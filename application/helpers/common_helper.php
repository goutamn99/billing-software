<?php
/* get the company data */
	function getCompanyData($id = null)
	{
		$CI =& get_instance();
        $CI->db->from('company');
        $CI->db->where('id',1);
        $query = $CI->db->get();
        return $query->row();
	}

	function getbillnum()
	{
		$CI =& get_instance();
        $CI->db->from('orders');
        $CI->db->order_by('id',"desc");
        $CI->db->limit(1);
        $query = $CI->db->get();
        return $query->row();
	}

        function get_perticular_count($tablename,$where=""){
                $CI =& get_instance();  
                $str="select * from ".$tablename." where 1=1 ".$where;
                //echo $str;
                $query=$CI->db->query($str);
                $record=$query->num_rows();
                return $record;
        
        }
        
        function get_perticular_field_value($tablename,$filedname,$where=""){
                $CI =& get_instance();  
                $str="select ".$filedname." from ".$tablename." where 1=1 ".$where;
                //echo $str."<br/>";
                $query=$CI->db->query($str);
                $record="";
                if($query->num_rows()>0){
                        
                        foreach($query->result_array() as $row){
                                $field_arr=explode(" as ", $filedname);
                                if(count($field_arr)>1){
                                        $filedname=$field_arr[1];
                                }else{
                                        $filedname=$field_arr[0];
                                }
                                $record=$row[$filedname];
                        }
                        
                }
                return $record;
        
        }