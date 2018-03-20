<?php
include('connection.php');

if(isset($_REQUEST['action']) && $_REQUEST['action']!="")
{
	$action = $_REQUEST['action'];
    $data = $_POST;
    if($action == 'signup')
    {

    	$data = json_decode( file_get_contents('php://input') );
    	//print_r($data);exit;
    	if(count($data) > 0)
       	{
       		if($data->first_name=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'first name is required';
            }
            else if($data->middle_name=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'middle name is required';
            }
            else if($data->last_name=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'last name is required';
            }
            else if($data->contact_no=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Mobile No is required';
            }
            else if($data->email=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Email is required';
            }
            else if($data->password=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Password is required';
            }
            else if($data->address=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Address is required';
            }
            else if($data->area=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Area is required';
            }
            else if($data->city=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'City is required';
            }
            else if($data->blood_group=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Blood Group is required';
            }
            else
            {
            	// for email validation
            	$qry = "select * from user where email = '".$data->email."'";
            	// for mobile no. validation
            	//$qry = "select * from user where contact_no = '".$data->contact_no."'";
            	$res = mysql_query($qry);
            	$count = mysql_num_rows($res);
            	
            	if(isset($count) && $count == 0)
            	{
            		$user_data['f_name'] = $data->first_name;
            		$user_data['m_name'] = $data->middle_name;
            		$user_data['l_name'] = $data->last_name;
            		$user_data['contact_no'] = $data->contact_no;
            		$user_data['email'] = $data->email;
            		$user_data['password'] = md5($data->password);
            		$user_data['address'] = $data->address;
            		$user_data['area'] = $data->area;
            		$user_data['city'] = $data->city;
            		$user_data['blood_group'] = $data->blood_group;
            		$user_data['created_date'] = date('Y-m-d H:i:s',time());
            		
            		$qry = "insert into user (".implode(",",array_keys($user_data)).") values('".implode("','", $user_data)."')";
            		//print_r($qry);exit;
            		 $res = mysql_query($qry);
            		if(isset($res) && $res == 1)
                    {
                    	$res_data['status'] = 'true';
                        $res_data['message'] = 'user signup successfully';
                        $res_data['data']['user_id'] = mysql_insert_id();
                        $res_data['data']['name'] = $data->first_name;
                    }
                    else{
                        $res_data['status'] = 'false';
                        $res_data['message'] = 'Error : unable to signup user';
                    }
            	}
            	else
            	{
            		$res_data['status'] = 'false';
            		// for email validation
                	$res_data['message'] = 'This email id is already registered';
                	// for mobile no. validation
                	//$res_data['message'] = 'This Mobile no. is already registered';
            	}
            }

       	}
       	else{
       		    $res_data['status'] = 'false';
                $res_data['message'] = 'Prameter is required';
       	}
       	
       	print_r(json_encode($res_data));
        exit;
    }
    else if ($action == 'login') 
    {

        $data = json_decode( file_get_contents('php://input') );

        if(count($data) > 0)
        {
            /*if($data->contact_no=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Mobile No is required';
            }*/
            if($data->email=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Email is required';
            }
            else if($data->password=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Password is required';
            }
            else
            {
                $password = md5($data->password);
                //for email login
                $qry = "select id,f_name from user where email = '".$data->email."' and password = '".$password."'";
                //for Mobile no login
                //$qry = "select id from user where contact_no = '".$data->contact_no."' and password = '".$password."'";
                $res = mysql_query($qry);
                $count = mysql_num_rows($res);

                if(isset($count) && $count != 0)
                {
                    $user_data = mysql_fetch_assoc($res);
                    $res_data['status'] = 'true';
                    $res_data['message'] = 'Login successfully';
                    $res_data['data'] = $user_data;
                }
                else
                {
                    $res_data['status'] = 'false';
                    $res_data['message'] = 'sorry email or password is wrong';
                }
            }
        }
        else
        {
            $res_data['status'] = 'false';
            $res_data['message'] = 'Prameter is required';
        }
        print_r(json_encode($res_data));
        exit;
    }
    // to post blood request for blood in need
    else if($action == 'post_request') //done
    {
        //$data = json_decode( file_get_contents('php://input') );
        //print_r($_POST['full_name']);exit;

        if(count($data) > 0)
        {
            if($data['full_name']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Full name is required';
            }
            else if($data['contact_no']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Contact No is required';   
            }
            else if($data['blood_group']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Blood Group is required';   
            }
            else if($data['state']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'State is required';   
            }
            else if($data['city']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'City is required';   
            }
            else if($data['unit']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Unit is required';   
            }
            else
            {
                $request_data['name'] = $data['full_name'];
                $request_data['contact_no'] = $data['contact_no'];
                $request_data['blood_group'] = $data['blood_group'];
                $request_data['state'] = $data['state'];
                $request_data['city'] = $data['city'];
                $request_data['hospital_name'] = $data['hospital_name'];
                $request_data['message'] = $data['message'];
                $request_data['request_status'] = 'P';
                $request_data['created_date'] = date('Y-m-d H:i:s',time());

                $qry = "insert into blood_request (".implode(",",array_keys($request_data)).") values('".implode("','", $request_data)."')";
                 $res = mysql_query($qry);
                if(isset($res) && $res == 1)
                {
                    $request_user_id = mysql_insert_id();
                    $req_unit['req_user_id'] = $request_user_id;
                    $req_unit['total_unit'] = $data['unit'];
                    $req_unit['pending_unit'] = $data['unit'];
                    $req_unit['created_date'] = date('Y-m-d H:i:s',time());

                    $qry1 = "insert into blood_unit (".implode(",",array_keys($req_unit)).") values('".implode("','", $req_unit)."')";

                    $res1 = mysql_query($qry1);
                    if(isset($res1) && $res1 == 1)
                    {
                        $res_data['status'] = 'Success';
                        $res_data['message'] = 'You request post successfully';
                        $res_data['data'] = $request_data;
                    }
                    else
                    {                        
                        $res_data['status'] = 'false';
                        $res_data['message'] = 'Error : unable to post request';       
                    }                    
                }
                else
                {
                    $res_data['status'] = 'false';
                    $res_data['message'] = 'Error : unable to post request';
                }




            }
        }
        else
        {
            $res_data['status'] = 'false';
            $res_data['message'] = 'Prameter is required';
        }   
        print_r(json_encode($res_data));
        exit;
    }
    //register  or get details when app installed
    else if($action == 'registerviaotp') //done
    {

        //$data = json_decode( file_get_contents('php://input') );

        if(count($data) > 0)
        {
            if($data['contact_no']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Contact no is required';
            }
            else if($data['device_token']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Device Token is required';   
            }
            else
            {
                //$qry = "select * from user where email = '".$data->email."'";
                // for mobile no. validation
                $qry = "select * from user where contact_no = '".$data['contact_no']."'";
                $res = mysql_query($qry);
                $count = mysql_num_rows($res);

                if(isset($count) && $count == 0)
                {
                    $user_data['contact_no'] = $data['contact_no'];
                    $user_data['created_date'] = date('Y-m-d H:i:s',time());
                    $user_data['last_login_time'] = date('Y-m-d H:i:s',time());

                    $apikey = "GkXRBN6fbUCLDkMep609OA";
                    $senderid = "TESTIN";
                    $otp = $six_digit_random_number = mt_rand(100000, 999999);
                    $msg ="Dear%20user,%20you%20verification%20code%20is%20$otp";
                    $user_data['otp'] = $otp;
                    $url = "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=".$apikey."&senderid=".$senderid."&channel=2&DCS=0&flashsms=0&number=91".$user_data['contact_no']."&text=".$msg."&route=1";

                    $ch=curl_init($url);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch,CURLOPT_POST,1);
                    curl_setopt($ch,CURLOPT_POSTFIELDS,"");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
                    $sms = curl_exec($ch);

                    $sms_status = json_decode($sms);
                    if($sms_status->ErrorMessage=='Success')
                    {
                        $qry = "insert into user (".implode(",",array_keys($user_data)).") values('".implode("','", $user_data)."')";
                        //print_r($qry);exit;
                        $res = mysql_query($qry);   

                        $user_token['user_id'] = mysql_insert_id();
                        $user_token['device_token'] = $data['device_token'];
                        $user_token['created_date'] = date('Y-m-d H:i:s');
                        $qry1 = "insert into user_tokens (".implode(",",array_keys($user_token)).") values('".implode("','", $user_token)."')";
                        $res1 = mysql_query($qry1);   

                         
                        if(isset($res) && $res == 1)
                        {
                            $res_data['status'] = 'true';
                            $res_data['message'] = 'OTP Send successfully';
                            $res_data['data']['user_id'] = $user_token['user_id'];
                            //$res_data['data']['name'] = $data->first_name;
                        }
                        else
                        {
                            $res_data['status'] = 'false';
                            $res_data['message'] = 'Please enter the valid Contact details';
                        }   
                    }
                    else
                    {
                        $res_data['status'] = 'True';
                        $res_data['message'] = 'Please enter the valid Contact details';
                    }                      
                }
                else
                {

                    $user_data = mysql_fetch_assoc($res);

                    $user_token['user_id'] = $user_data['id'];
                    $user_token['device_token'] = $data['device_token'];
                    $user_token['created_date'] = date('Y-m-d H:i:s');
                    $qry2 = "insert into user_tokens (".implode(",",array_keys($user_token)).") values('".implode("','", $user_token)."')";

                    $res2 = mysql_query($qry2);   

                    $res_data['status'] = 'True';
                    $res_data['message'] = 'User is already register';
                    $res_data['data'] = $user_data;       

                    

                }
            }
        }
        else
        {
            $res_data['status'] = 'false';
            $res_data['message'] = 'Prameter is required';
        }
        print_r(json_encode($res_data));
            exit;
    }
    //otp verification of user
    else if ($action=='verifyotp') //done
    {
        if(count($data) > 0)
        {
            if($data['user_id']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'user id is required';
            }
            else if($data['otp']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'OTP is required';   
            }
            else
            {
                //$qry = "select * from user where email = '".$data->email."'";
                // for mobile no. validation
                $qry = "select id,contact_no from user where otp = ".$data['otp']." and id = ".$data['user_id']."";
                $res = mysql_query($qry);
                $count = mysql_num_rows($res);

                if(isset($count) && $count != 0)
                {
                    $update_qry = "update user set is_active = 1 where id = ".$data['user_id']."";
                    $update_res = mysql_query($update_qry);
                    $user_data = mysql_fetch_assoc($res);
                    $res_data['status'] = 'true';
                    $res_data['message'] = 'Your OTP code is verfied';
                    $res_data['data'] = $user_data;
                }
                else
                {
                    $res_data['status'] = 'false';
                    $res_data['message'] = 'Please enter the invalid OTP detail';
                }                         
            }
        }
        else
        {
            $res_data['status'] = 'false';
            $res_data['message'] = 'Prameter is required';
        }
        print_r(json_encode($res_data));
        exit;    
    }
    // add member detail when user is register
    elseif ($action=='addmember') 
    {
         //$data = json_decode( file_get_contents('php://input') );

         if (count($data) > 0) {
        
            if($data['first_name']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'first name is required';
            }
            else if($data['middle_name']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'middle name is required';
            }
            else if($data['last_name']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'last name is required';
            }
            else if($data['contact_no']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Mobile No is required';
            }
            else if($data['email']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Email is required';
            }
            else if($data['address']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Address is required';
            }
            else if($data['area']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Area is required';
            }
            else if($data['city']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'City is required';
            }
            else if($data['blood_group']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Blood Group is required';
            }
            else
            {
                   $qry = "UPDATE `user` SET `f_name`='".$data['first_name']."',`m_name`='".$data['middle_name']."',`l_name`='".$data['last_name']."',`otp`='',
                            `email`='".$data['email']."',`Address`='".$data['address']."',`area`='".$data['area']."',`city`='".$data['city']."',
                            `blood_group`='".$data['blood_group']."',`is_active`=1,`Updated_date`='".date("Y-m-d H:i:s")."' WHERE contact_no = ".$data['contact_no']."";
                    $res = mysql_query($qry);


                    $qry1 = "select * from user where contact_no = '".$data['contact_no']."'";
                    $res1 = mysql_query($qry1);

                    $count = mysql_num_rows($res1);

                    if(isset($count) && $count > 0)
                    {
                        $user_data = mysql_fetch_assoc($res1);
                        $res_data['status'] = 'true';
                        $res_data['message'] = 'Member detail updated successfully';
                        $res_data['data'] = $user_data;             
                    }
                    else
                    {
                        $res_data['status'] = 'false';
                        $res_data['message'] = 'No Data Found';
                        $res_data['data'] = $data;                 
                    }

                    
            }
        }
         else
         {
            $res_data['status'] = 'false';
            $res_data['message'] = 'Prameter is required';
         }
        print_r(json_encode($res_data));
        exit;    
    }
    // add refer member by current user
    elseif($action == 'refermember')
    {
        //$data = json_decode( file_get_contents('php://input') );
        //print_r($data);exit;
        if(count($data) > 0)
        {
            if($data['first_name']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'first name is required';
            }
            else if($data['middle_name']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'middle name is required';
            }
            else if($data['last_name']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'last name is required';
            }
            else if($data['contact_no']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Mobile No is required';
            }
            else if($data['email']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Email is required';
            }
            else if($data['address']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Address is required';
            }
            else if($data['area']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Area is required';
            }
            else if($data['city']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'City is required';
            }
            else if($data['blood_group']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Blood Group is required';
            }
            else
            {
                // for email validation
                //$qry = "select * from user where email = '".$data['email']."'";
                // for mobile no. validation
                $qry = "select * from user where contact_no = '".$data['contact_no']."'";
                $res = mysql_query($qry);
                $count = mysql_num_rows($res);
                
                if(isset($count) && $count == 0)
                {
                    $user_data['f_name'] = $data['first_name'];
                    $user_data['m_name'] = $data['middle_name'];
                    $user_data['l_name'] = $data['last_name'];
                    $user_data['contact_no'] = $data['contact_no'];
                    $user_data['email'] = $data['email'];
                    $user_data['address'] = $data['address'];
                    $user_data['area'] = $data['area'];
                    $user_data['city'] = $data['city'];
                    $user_data['blood_group'] = $data['blood_group'];
                    $user_data['created_date'] = date('Y-m-d H:i:s',time());
                    if($data['ref_user_id']!="")
                    {
                        $user_data['ref_user_id'] = $data['ref_user_id'];
                    }

                    
                    $qry = "insert into user (".implode(",",array_keys($user_data)).") values('".implode("','", $user_data)."')";
                    //print_r($qry);exit;
                     $res = mysql_query($qry);
                    if(isset($res) && $res == 1)
                    {
                        $res_data['status'] = 'true';
                        $res_data['message'] = 'Member added successfully';
                        $res_data['data']['user_id'] = mysql_insert_id();
                        $res_data['data']['name'] = $data['first_name'];
                    }
                    else{
                        $res_data['status'] = 'false';
                        $res_data['message'] = 'Error : unable to add member';
                    }
                }
                else
                {
                    $res_data['status'] = 'false';
                    // for email validation
                    //$res_data['message'] = 'This email id is already registered';
                    // for mobile no. validation
                    $res_data['message'] = 'This Mobile no. is already registered';
                }
            }

        }
        else{
                $res_data['status'] = 'false';
                $res_data['message'] = 'Prameter is required';
        }
        
        print_r(json_encode($res_data));
        exit;   
    }
    // serach blood request user of blood
    elseif ($action == 'searchblood') 
    {
        //$data = json_decode( file_get_contents('php://input') );

        if(count($data) > 0)
        {
            if($data['blood_group']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Blood group is required';
            }
            else
            {
                $qry = "select * from user where blood_group ='".$data['blood_group']."'";
                $res = mysql_query($qry);

                $count = mysql_num_rows($res);

                if(isset($count) && $count != 0)
                {
                    for ($i=0; $i < $count; $i++) { 
                        $user_data[$i] = mysql_fetch_assoc($res);
                    }
                    //print_r($user_data);exit;   
                    $res_data['status'] = 'true';
                    $res_data['data'] = $user_data;
                }
                else
                {
                    $res_data['status'] = 'false';
                    $res_data['message'] = "No data found";   
                }

            }
        }
        else
        {
            $res_data['status'] = 'false';
            $res_data['message'] = 'Prameter is required';
        }
        print_r(json_encode($res_data));
        exit;
    }
    // display the user list of pending request
    elseif ($action =='in_need') 
    {

        $inneed_qry = "select * from blood_request where request_status = 'p'";
        $res = mysql_query($inneed_qry);
        $count = mysql_num_rows($res);

        if(isset($count) && $count > 0)
        {

            for($i=0; $i<$count; $i++) { 
                $user_data[$i] = mysql_fetch_assoc($res);
            }
            //print_r($user_data);exit;
            $res_data['status'] = "true";
            $res_data['data'] = $user_data;    
        }
        else
        {
            $res_data['status'] = "false";
            $res_data['data'] = "No people are in need of blood";       
        }
        print_r(json_encode($res_data));
        exit;
        
    }
    else if($action == 'reminder_date')
    {
        if(count($data) > 0)
        {
            if($data['user_id']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'User id is required';
            }
            else
            {
                $qry = "select donated_date from donor_donate_detail 
                        where donor_id=".$data['user_id']." order by donor_donate_detail.id desc";
                $res = mysql_query($qry);
                $count = mysql_num_rows($res);
                if(isset($count) && $count != 0)
                {
                    $user_data = mysql_fetch_assoc($res);
                    //print_r($user_data);exit;
                    $res_data['status'] = 'true';
                    $res_data['data']['donated_date'] =  date('Y-m-d H:i:s', strtotime("+3 months", strtotime($user_data['donated_date'])));
                }
                else
                {
                    $res_data['status'] = 'false';
                    $res_data['message'] = "No data found";   
                }


            }
        }
        else
        {
            $res_data['status'] = 'false';
            $res_data['message'] = 'Prameter is required';
        }
        print_r(json_encode($res_data));
        exit;
    }
    else if($action == 'generate_pdf')
    {
        
        
    }
    else if($action == 'push_notification')
    {
        if(count($data) > 0)
        {
            if($data['device_token']=="")
            {
                $res_data['status'] = 'false';
                $res_data['message'] = 'Device token is required';
            }
            else
            {
                $tokens=array($data['device_token']);
                $server_key = 'AAAAUfXyifg:APA91bH4TpyoYGHYronGwkyAAtKPC3jf9yDxY5jeuhHB7RXrEZUpyRX21ofKY3JnpmW5ehBxpPH-rflwqTDMvhxEnhGgbFiUVFndewKeLW7NlPDN0SdhrA2RLHPkOVnLa7sEobyXdL2r';
                $url = 'https://fcm.googleapis.com/fcm/send';
                $priority="high";
                $pushData=array("title"=>"test","body"=>"message");
                $data=array("key1"=>"value1","key2"=>"value2","key3"=>"value3","key4"=>"value4");
                $fields = array(
                     'to' => $tokens[0],
                     'notification' => $pushData,
                     'data'=>$data
                );
                $headers = array(
                'Authorization:key='.$server_key,
                'Content-Type: application/json'
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                echo curl_error($ch);
                   if ($result === FALSE) {
                       die('Curl failed: ' . curl_error($ch));
                   }
                   curl_close($ch);
                   echo $result;
            }
        }
        else
        {
            $res_data['status'] = 'false';
            $res_data['message'] = 'Prameter is required';
        }      
    }
    else
    {
        exit("please enter correct action");
    }
}
else
{
    exit("please enter the action");
}
?>