<?php
$mysql_db_hostname = $_ENV['DB_HOST'];
$mysql_db_user = $_ENV['DB_USER'];
$mysql_db_password = $_ENV['DB_PASS'];
$mysql_db_database = $_ENV['DB_DATA'];
$mysql_db_port     = isset($_ENV['DB_PORT']) ? (int)$_ENV['DB_PORT'] : 3306; // Default to 3306

$conn = new mysqli($mysql_db_hostname, $mysql_db_user, $mysql_db_password, $mysql_db_database, $mysql_db_port);
//$conn = new mysqli($mysql_db_hostname, $mysql_db_user, $mysql_db_password, $mysql_db_database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$holidays = array(
	"January 1", //New Years Day (static)
	//"January 2", //Day after New Years
	"February 18", //Family Day (3rd Monday in February)
	"April 18", //Good Friday (varies)
	"April 21", //Easter Monday (varies)
	"May 19", //Victoria Day (Monday before May 25)
	"July 1", //Canada Day (static)
	"August 4", //Civic Holiday (1st Monday in August) - Only Federal employees
	"September 1", //Labour Day (1st Monday in September)
	"October 13", //Thanksgiving (2nd Monday in October)
	"November 11", //Remembrance Day (static)
	"December 25", //Christmas Day (static)
	"December 26", //Boxing Day (static)
);

date_default_timezone_set("America/Toronto");
$todays_date = date("F j");
$day_of_week = date("w");//M-F --> should be >0, but <6
$current_hour = date("G");
$holiday_bool = '0';

if (in_array($todays_date, $holidays))
  {
 $holiday_bool = '1';
 }
 
//if($holiday_bool=='0' && $day_of_week>0 && $day_of_week<6 && $current_hour>8 && $current_hour<19){
if($holiday_bool=='0' && $day_of_week>0 && $day_of_week<7 && $current_hour>8){
 //echo "Working Day";
//$query=mysql_query("select * from orders WHERE status!='pending' AND status!='review' AND status!='completed' ORDER BY id ASC limit 1");
$sql="select * from orders WHERE status!='pending' AND status!='review' AND status!='completed' ORDER BY id ASC limit 1";
}else{
//$query=mysql_query("select * from orders WHERE type='nuans' AND status!='review' AND status!='completed' ORDER BY id ASC limit 1");
$sql="select * from orders WHERE type='nuans' AND status!='review' AND status!='completed' ORDER BY id ASC limit 1";
}
//$sql="select * from orders WHERE id='5127'";

$type = "none";
$company_name = "none";
$city = "none";
$on_bin = "none";
$tos = "none";
$tor = "none";

$type_of_company = "none";
$legal_ending = "none";
$reservation_number = "none";
$post_dated = "none";
$req_num_directors = "none";
$fixed_num_directors = "none";
$range_from_directors = "none";
$range_to_directors = "none";
$street_num = "none";
$street_name = "none";
$suite = "none";
$additional_info = "none";
$province = "none";
$country = "none";
$postal_code = "none";

$a_share_structure = "none";
$share_structure = "none";
$b_rights_priv = "none";
$rights_priv = "none";
$c_restrictions = "none";
$restrictions = "none";
$d_limitations = "none";
$limitations = "none";
$e_other_provisions = "none";
$other_provisions = "none";

$num_first_directors = "none";

$d1_first = "none";
$d1_middle = "none";
$d1_last = "none";
$d1_c_res = "none";
$d1_street_num = "none";
$d1_street_name = "none";
$d1_suite = "none";
$d1_city = "none";
$d1_province = "none";
$d1_country = "none";
$d1_postal_code = "none";

$d2_first = "none";
$d2_middle = "none";
$d2_last = "none";
$d2_c_res = "none";
$d2_street_num = "none";
$d2_street_name = "none";
$d2_suite = "none";
$d2_city = "none";
$d2_province = "none";
$d2_country = "none";
$d2_postal_code = "none";

$d3_first = "none";
$d3_middle = "none";
$d3_last = "none";
$d3_c_res = "none";
$d3_street_num = "none";
$d3_street_name = "none";
$d3_suite = "none";
$d3_city = "none";
$d3_province = "none";
$d3_country = "none";
$d3_postal_code = "none";

$d4_first = "none";
$d4_middle = "none";
$d4_last = "none";
$d4_c_res = "none";
$d4_street_num = "none";
$d4_street_name = "none";
$d4_suite = "none";
$d4_city = "none";
$d4_province = "none";
$d4_country = "none";
$d4_postal_code = "none";

$d5_first = "none";
$d5_middle = "none";
$d5_last = "none";
$d5_c_res = "none";
$d5_street_num = "none";
$d5_street_name = "none";
$d5_suite = "none";
$d5_city = "none";
$d5_province = "none";
$d5_country = "none";
$d5_postal_code = "none";

$num_incorporators = "none";

$i1_first = "none";
$i1_middle = "none";
$i1_last = "none";
$i1_c_res = "none";
$i1_street_num = "none";
$i1_street_name = "none";
$i1_suite = "none";
$i1_city = "none";
$i1_province = "none";
$i1_country = "none";
$i1_postal_code = "none";

$i2_first = "none";
$i2_middle = "none";
$i2_last = "none";
$i2_c_res = "none";
$i2_street_num = "none";
$i2_street_name = "none";
$i2_suite = "none";
$i2_city = "none";
$i2_province = "none";
$i2_country = "none";
$i2_postal_code = "none";

$i3_first = "none";
$i3_middle = "none";
$i3_last = "none";
$i3_c_res = "none";
$i3_street_num = "none";
$i3_street_name = "none";
$i3_suite = "none";
$i3_city = "none";
$i3_province = "none";
$i3_country = "none";
$i3_postal_code = "none";

$i4_first = "none";
$i4_middle = "none";
$i4_last = "none";
$i4_c_res = "none";
$i4_street_num = "none";
$i4_street_name = "none";
$i4_suite = "none";
$i4_city = "none";
$i4_province = "none";
$i4_country = "none";
$i4_postal_code = "none";

$i5_first = "none";
$i5_middle = "none";
$i5_last = "none";
$i5_c_res = "none";
$i5_street_num = "none";
$i5_street_name = "none";
$i5_suite = "none";
$i5_city = "none";
$i5_province = "none";
$i5_country = "none";
$i5_postal_code = "none";

$existing_corp_name = "none";
$existing_corp_number = "none";
$business_activity = "none";
$products_services_provided = "none";
$operate_in_ontario = "none";
$hire_employees = "none";
$annual_payroll = "none";
$eht_number = "none";
$hire_contractors = "none";
$hire_date = "none";
$wsib_account = "none";
$personal_wsib = "none";
$business_phone = "none";
$same_as_business = "none";

$i2_phone = "none";
$d1_phone = "none";
$d2_phone = "none";
$d3_phone = "none";
$d4_phone = "none";
$d5_phone = "none";
$i3_phone = "none";

$email1 = "none";
$cust_name = "none";
$order_id = "none";
$rid = "none";
$jur = "0";

$contact_first = "none";
$contact_last = "none";
$contact_st_num = "none";
$contact_st_name = "none";
$contact_city = "none";
$contact_province = "none";
$contact_country = "none";
$contact_postal = "none";
$contact_phone = "none";
$consent_first = "none";
$consent_last = "none";

$reservation_date = "none";
$primary_business_activity = "none";
$official_email = "none";

$site = "none";
$review_status = 0;

//while($row = mysql_fetch_assoc($query)){
$result = $conn->query($sql);

    // output data of each row
while($row = $result->fetch_assoc()) {
$type_check = $row[type];

$data_contact_first = $row["contact_first"];
$data_contact_last = $row["contact_last"];
$data_contact_st_num = $row["contact_st_num"];
$data_contact_city = $row["contact_city"];
$data_contact_province = $row["contact_province"];
$data_contact_country = $row["contact_country"];
$data_contact_postal = $row["contact_postal"];
$data_contact_phone = $row["contact_phone"];
$data_consent_first = $row["consent_first"];
$data_consent_last = $row["consent_last"];

if ($type_check=="ont_inc" && $data_contact_first=='' && $data_contact_last=="" && $data_contact_st_num=="" && $data_contact_city=="" && $data_contact_province=="" && $data_contact_country=="" && $data_contact_postal=="" && $data_contact_phone=="" && $data_contact_phone=="" && $data_consent_first=="" && $data_consent_last==""){
    $data_id = $row[id];
    $data_on = $row[order_number];
    $data_key = $row[order_time];
    $data_e = $row[email];
    $data_name = $row[name];
    $data_Cname = $row[cust_name];
    
    $data_type_of_company = $row[type_of_company];
    
$from = "Opstart <orders@opstartnotifications.com>"; 
$to = "$data_e";
if($data_type_of_company=="Numbered Company"){
    $subject = "Additional Business Registration Details Required - Order# $data_on"; 
}else{
    $subject = "Additional Business Registration Details Required - $data_name"; 
}
$body = "Hi $data_Cname,
<br/><br/>
Additional information is required to process your Ontario Incorporation.
<br/><br/>
<a href='https://updates.opstart.ca/ontario-incorporation-review-and-submit/?on=$data_on&k=$data_key&e=$data_e'>Click Here to submit the necessary information.</a>
<br/><br/>
Once we receive the requested information we can proceed with your Ontario Incorporation.
<br/><br/>
Thanks.
<br/><br/>
- The Opstart Team";

$site = $row[site];
if($site=="NE"){
    $from = "NUANS Experts <notifications@email.nuans-experts.com>"; 
    $subject = "Incorporation Details Required - $data_name";
    $body = "Hi $data_Cname,
<br/><br/>
Please submit the required information to process your Ontario Incorporation.
<br/><br/>
<a href='https://nuans-experts.com/ontario-incorporation-review-and-submit/?on=$data_on&k=$data_key&e=$data_e'>Click Here to submit the necessary information.</a>
<br/><br/>
Once we receive the requested information we can proceed with your Ontario Incorporation.
<br/><br/>
Thanks.
<br/><br/>
<strong>- NUANS Experts Support</strong>";

}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/opstartnotifications.com/messages');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$post = array(
    'from' => $from,
    'to' => $to,
    'subject' => $subject,
    'html' => $body
);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_USERPWD, 'api' . ':' . $_ENV['MAILGUN_API_KEY']);

$emailResult = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

//Mark record as pending
$sql1 = "Update orders SET status='pending' WHERE id='$data_id'";
$conn->query($sql1);
}elseif($type_check=="m_business" && $data_consent_last==""){
    $data_id = $row[id];
    $data_on = $row[order_number];
    $data_key = $row[order_time];
    $data_e = $row[email];
    $data_name = $row[name];
    $data_Cname = $row[cust_name];
    
$from = "Opstart <orders@opstartnotifications.com>"; 
$to = "$data_e";
$subject = "Additional Business Registration Details Required - $data_name"; 
$body = "Hi $data_Cname,
<br/><br/>
Additional information is required to process your Business Registration.
<br/><br/>
<a href='https://updates.opstart.ca/master-business-licence-verification/?on=$data_on&k=$data_key&e=$data_e'>Click Here to submit the necessary information.</a>
<br/><br/>
Once we receive the requested information we can proceed with your Business Registration.
<br/><br/>
Thanks.
<br/><br/>
- The Opstart Team";

$site = $row[site];
if($site=="NE"){
    $from = "NUANS Experts <notifications@email.nuans-experts.com>"; 
    $subject = "Business Registration Details Required - $data_name";
    $body = "Hi $data_Cname,
<br/><br/>
Please submit the required information to process your Business Registration.
<br/><br/>
<a href='https://nuans-experts.com/master-business-licence-verification/?on=$data_on&k=$data_key&e=$data_e'>Click Here to submit the necessary information.</a>
<br/><br/>
Once we receive the requested information we can proceed with your Business Registration.
<br/><br/>
Thanks.
<br/><br/>
<strong>- NUANS Experts Support</strong>";

}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/opstartnotifications.com/messages');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$post = array(
    'from' => $from,
    'to' => $to,
    'subject' => $subject,
    'html' => $body
);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_USERPWD, 'api' . ':' . $_ENV['MAILGUN_API_KEY']);

$emailResult = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

//Mark record as pending
$sql1 = "Update orders SET status='pending' WHERE id='$data_id'";
$conn->query($sql1);
}else{
    
$type = $row[type];
$company_name = $row[name];
$company_name = str_replace('"','\"',$company_name);
$company_name = htmlspecialchars_decode($company_name);

$city = $row[city];
$on_bin = $row[on_bin];
if($type=="c_profile"|| $type=="enhanced"){
$first = substr($on_bin,0,1);

while(preg_match("/[a-z]/i", $first)){
		$on_bin = substr($on_bin,1);
		$first = substr($on_bin,0,1);
}
$on_bin= ltrim($on_bin, '-');
$on_bin = ltrim($on_bin, '0');

}

$tos = $row[type_of_search];
$tor = $row[type_of_report];
if($tor=="Detailed Business Names Report ($ 8.00 CAD)"){
$tor="UBNR";
}elseif($tor=="Certified Detailed Business Names Report ($ 16.00 CAD)"){
$tor="CBNR";
}elseif($tor=="Statement of No Match Found ($ 8.00 CAD)"){
$tor="SNM";
}elseif($tor=="Certificate of Non-Registration ($ 26.00 CAD)"){
$tor="CNR";
}elseif($tor=="Certified ($ 10.00 CAD)"){
$tor="certified";
}

$type_of_company = $row[type_of_company];
$legal_ending = $row[legal_ending];
$reservation_number = $row[reservation_number];
$post_dated = $row[post_dated];
$req_num_directors = $row[req_num_directors];
$fixed_num_directors = $row[fixed_num_directors];
$range_from_directors = $row[range_from_directors];
$range_to_directors = $row[range_to_directors];
$street_num = $row[street_num];
$street_name = $row[street_name];
$suite = $row[suite];
$additional_info = $row[additional_info];
$province = $row[province];
$country = $row[country];
$postal_code = $row[postal_code];

$a_share_structure = $row[a_share_structure];
$share_structure = $row[share_structure];
$share_structure = str_replace("\r\n", "\n", $share_structure);
$share_structure = preg_replace('/\n/', '\n', $share_structure);
//$share_structure = str_replace('"', "\"", $share_structure);
$b_rights_priv = $row[b_rights_priv];
$rights_priv = $row[rights_priv];
$rights_priv = str_replace("\r\n", "\n", $rights_priv);
$rights_priv = preg_replace('/\n/', '\n', $rights_priv);
//$rights_priv = str_replace('"', "\"", $rights_priv);
$c_restrictions = $row[c_restrictions];
$restrictions = $row[restrictions];
$restrictions = str_replace("\r\n", "\n", $restrictions);
$restrictions = preg_replace('/\n/', '\n', $restrictions);
//$restrictions = str_replace('"', "\"", $restrictions);
$d_limitations = $row[d_limitations];
$limitations = $row[limitations];
$limitations = str_replace("\r\n", "\n", $limitations);
$limitations = preg_replace('/\n/', '\n', $limitations);
//$limitations = str_replace('"', "\"", $limitations);
$e_other_provisions = $row[e_other_provisions];
$other_provisions = $row[other_provisions];
$other_provisions = str_replace("\r\n", "\n", $other_provisions);
$other_provisions = preg_replace('/\n/', '\n', $other_provisions);
//$other_provisions = str_replace('"', "\"", $other_provisions);
$num_first_directors = $row[num_first_directors];

$d1_first = $row[d1_first];
$d1_middle = $row[d1_middle];
$d1_last = $row[d1_last];
$d1_c_res = $row[d1_c_res];
$d1_street_num = $row[d1_street_num];
$d1_street_name = $row[d1_street_name];
$d1_suite = $row[d1_suite];
$d1_city = $row[d1_city];
$d1_province = $row[d1_province];
$d1_country = $row[d1_country];
$d1_postal_code = $row[d1_postal_code];

$d2_first = $row[d2_first];
$d2_middle = $row[d2_middle];
$d2_last = $row[d2_last];
$d2_c_res = $row[d2_c_res];
$d2_street_num = $row[d2_street_num];
$d2_street_name = $row[d2_street_name];
$d2_suite = $row[d2_suite];
$d2_city = $row[d2_city];
$d2_province = $row[d2_province];
$d2_country = $row[d2_country];
$d2_postal_code = $row[d2_postal_code];

$d3_first = $row[d3_first];
$d3_middle = $row[d3_middle];
$d3_last = $row[d3_last];
$d3_c_res = $row[d3_c_res];
$d3_street_num = $row[d3_street_num];
$d3_street_name = $row[d3_street_name];
$d3_suite = $row[d3_suite];
$d3_city = $row[d3_city];
$d3_province = $row[d3_province];
$d3_country = $row[d3_country];
$d3_postal_code = $row[d3_postal_code];

$d4_first = $row[d4_first];
$d4_middle = $row[d4_middle];
$d4_last = $row[d4_last];
$d4_c_res = $row[d4_c_res];
$d4_street_num = $row[d4_street_num];
$d4_street_name = $row[d4_street_name];
$d4_suite = $row[d4_suite];
$d4_city = $row[d4_city];
$d4_province = $row[d4_province];
$d4_country = $row[d4_country];
$d4_postal_code = $row[d4_postal_code];

$d5_first = $row[d5_first];
$d5_middle = $row[d5_middle];
$d5_last = $row[d5_last];
$d5_c_res = $row[d5_c_res];
$d5_street_num = $row[d5_street_num];
$d5_street_name = $row[d5_street_name];
$d5_suite = $row[d5_suite];
$d5_city = $row[d5_city];
$d5_province = $row[d5_province];
$d5_country = $row[d5_country];
$d5_postal_code = $row[d5_postal_code];

$num_incorporators = $row[num_incorporators];

$i1_first = $row[i1_first];
$i1_middle = $row[i1_middle];
$i1_last = $row[i1_last];
$i1_c_res = $row[i1_c_res];
$i1_street_num = $row[i1_street_num];
$i1_street_name = $row[i1_street_name];
$i1_suite = $row[i1_suite];
$i1_city = $row[i1_city];
$i1_province = $row[i1_province];
$i1_country = $row[i1_country];
$i1_postal_code = $row[i1_postal_code];

$i2_first = $row[i2_first];
$i2_middle = $row[i2_middle];
$i2_last = $row[i2_last];
$i2_c_res = $row[i2_c_res];
$i2_street_num = $row[i2_street_num];
$i2_street_name = $row[i2_street_name];
$i2_suite = $row[i2_suite];
$i2_city = $row[i2_city];
$i2_province = $row[i2_province];
$i2_country = $row[i2_country];
$i2_postal_code = $row[i2_postal_code];

$i3_first = $row[i3_first];
$i3_middle = $row[i3_middle];
$i3_last = $row[i3_last];
$i3_c_res = $row[i3_c_res];
$i3_street_num = $row[i3_street_num];
$i3_street_name = $row[i3_street_name];
$i3_suite = $row[i3_suite];
$i3_city = $row[i3_city];
$i3_province = $row[i3_province];
$i3_country = $row[i3_country];
$i3_postal_code = $row[i3_postal_code];

$i4_first = $row[i4_first];
$i4_middle = $row[i4_middle];
$i4_last = $row[i4_last];
$i4_c_res = $row[i4_c_res];
$i4_street_num = $row[i4_street_num];
$i4_street_name = $row[i4_street_name];
$i4_suite = $row[i4_suite];
$i4_city = $row[i4_city];
$i4_province = $row[i4_province];
$i4_country = $row[i4_country];
$i4_postal_code = $row[i4_postal_code];

$i5_first = $row[i5_first];
$i5_middle = $row[i5_middle];
$i5_last = $row[i5_last];
$i5_c_res = $row[i5_c_res];
$i5_street_num = $row[i5_street_num];
$i5_street_name = $row[i5_street_name];
$i5_suite = $row[i5_suite];
$i5_city = $row[i5_city];
$i5_province = $row[i5_province];
$i5_country = $row[i5_country];
$i5_postal_code = $row[i5_postal_code];

$existing_corp_name = $row[existing_corp_name];
$existing_corp_number = $row[existing_corp_number];
$business_activity = $row[business_activity];
$products_services_provided = $row[products_services_provided];
$operate_in_ontario = $row[operate_in_ontario];
$hire_employees = $row[hire_employees];
$annual_payroll = $row[annual_payroll];
$eht_number = $row[eht_number];
$hire_contractors = $row[hire_contractors];
$hire_date = $row[hire_date];
$wsib_account = $row[wsib_account];
$personal_wsib = $row[personal_wsib];
$business_phone = $row[business_phone];
$same_as_business = $row[same_as_business];

$i2_phone = $row[i2_phone];
$d1_phone = $row[d1_phone];
$d2_phone = $row[d2_phone];
$d3_phone = $row[d3_phone];
$d4_phone = $row[d4_phone];
$d5_phone = $row[d5_phone];
$i3_phone = $row[i3_phone];

$contact_first = $row[contact_first];
$contact_last = $row[contact_last];
$contact_st_num = $row[contact_st_num];
$contact_st_name = $row[contact_st_name];
$contact_city = $row[contact_city];
$contact_province = $row[contact_province];
$contact_country = $row[contact_country];
$contact_postal = $row[contact_postal];
$contact_phone = $row[contact_phone];
$consent_first = $row[consent_first];
$consent_last = $row[consent_last];

$contact_province = strtoupper($contact_province);
$contact_province = trim($contact_province);

if($contact_province=="ONTARIO"){
    $contact_province="ON";
}

$contact_country = strtoupper($contact_country);
$contact_country = trim($contact_country);
if($contact_country=="CANADA"){
    $contact_country="CA";
}

$reservation_date = $row[nuans_date];
$primary_business_activity = $row[primary_business_activity];
$official_email = $row[official_email];

$site = $row[site];

$review_status = $row[review_status];

$email1 = $row[email];
$cust_name = $row[cust_name];
$order_id = $row[order_number];
$rid = $row[id];
$jur = $row[jurisdiction];
if($jur=="Federal"){
$jur='6';
}elseif ($jur=="Ontario") {
$jur='17';
}elseif ($jur=="Alberta") {
$jur='3';
}elseif ($jur=="Alberta Trade Name") {
$jur='1';
}elseif ($jur=="New Brunswick") {
$jur='11';
}elseif ($jur=="Northwest Territories") {
$jur='13';
}elseif ($jur=="Nova Scotia") {
$jur='15';
}elseif ($jur=="Prince Edward Island") {
$jur='19';
}

//end of if ont_inc and conatct/consent info blank
}

//end of while
}

echo "<p id='type'>$type</p>";
echo "<p id='jurisdiction'>$jur</p>";
echo "<p id='name'>$company_name</p>";
echo "<p id='city'>$city</p>";
echo "<p id='on_bin'>$on_bin</p>";
echo "<p id='tos'>$tos</p>";
echo "<p id='tor'>$tor</p>";
echo "<p id='order'>$order_id</p>";
echo "<p id='cust_name'>$cust_name</p>";
echo "<p id='email'>$email1</p>";
echo "<p id='rid'>$rid</p>";
  
echo "<p id='type_of_company'>$type_of_company</p>";
$legal_ending = strtoupper($legal_ending);
echo "<p id='legal_ending'>$legal_ending</p>";
echo "<p id='reservation_number'>$reservation_number</p>";
echo "<p id='post_dated'>$post_dated</p>";
echo "<p id='req_num_directors'>$req_num_directors</p>";
echo "<p id='fixed_num_directors'>$fixed_num_directors</p>";
echo "<p id='range_from_directors'>$range_from_directors</p>";
echo "<p id='range_to_directors'>$range_to_directors</p>";
echo "<p id='street_num'>$street_num</p>";
echo "<p id='street_name'>$street_name</p>";
echo "<p id='suite'>$suite</p>";
echo "<p id='additional_info'>$additional_info</p>";
echo "<p id='province'>$province</p>";
echo "<p id='country'>$country</p>";
echo "<p id='postal_code'>$postal_code</p>";

echo "<p id='a_share_structure'>$a_share_structure</p>";
echo "<p id='share_structure'>$share_structure</p>";
echo "<p id='b_rights_priv'>$b_rights_priv</p>";
echo "<p id='rights_priv'>$rights_priv</p>";
echo "<p id='c_restrictions'>$c_restrictions</p>";
echo "<p id='restrictions'>$restrictions</p>";
echo "<p id='d_limitations'>$d_limitations</p>";
echo "<p id='limitations'>$limitations</p>";
echo "<p id='e_other_provisions'>$e_other_provisions</p>";
echo "<p id='other_provisions'>$other_provisions</p>";

echo "<p id='num_first_directors'>$num_first_directors</p>";

echo "<p id='d1_first'>$d1_first</p>";
echo "<p id='d1_middle'>$d1_middle</p>";
echo "<p id='d1_last'>$d1_last</p>";
echo "<p id='d1_c_res'>$d1_c_res</p>";
echo "<p id='d1_street_num'>$d1_street_num</p>";
echo "<p id='d1_street_name'>$d1_street_name</p>";
echo "<p id='d1_suite'>$d1_suite</p>";
echo "<p id='d1_city'>$d1_city</p>";
echo "<p id='d1_province'>$d1_province</p>";
echo "<p id='d1_country'>$d1_country</p>";
echo "<p id='d1_postal_code'>$d1_postal_code</p>";

echo "<p id='d2_first'>$d2_first</p>";
echo "<p id='d2_middle'>$d2_middle</p>";
echo "<p id='d2_last'>$d2_last</p>";
echo "<p id='d2_c_res'>$d2_c_res</p>";
echo "<p id='d2_street_num'>$d2_street_num</p>";
echo "<p id='d2_street_name'>$d2_street_name</p>";
echo "<p id='d2_suite'>$d2_suite</p>";
echo "<p id='d2_city'>$d2_city</p>";
echo "<p id='d2_province'>$d2_province</p>";
echo "<p id='d2_country'>$d2_country</p>";
echo "<p id='d2_postal_code'>$d2_postal_code</p>";

echo "<p id='d3_first'>$d3_first</p>";
echo "<p id='d3_middle'>$d3_middle</p>";
echo "<p id='d3_last'>$d3_last</p>";
echo "<p id='d3_c_res'>$d3_c_res</p>";
echo "<p id='d3_street_num'>$d3_street_num</p>";
echo "<p id='d3_street_name'>$d3_street_name</p>";
echo "<p id='d3_suite'>$d3_suite</p>";
echo "<p id='d3_city'>$d3_city</p>";
echo "<p id='d3_province'>$d3_province</p>";
echo "<p id='d3_country'>$d3_country</p>";
echo "<p id='d3_postal_code'>$d3_postal_code</p>";

echo "<p id='d4_first'>$d4_first</p>";
echo "<p id='d4_middle'>$d4_middle</p>";
echo "<p id='d4_last'>$d4_last</p>";
echo "<p id='d4_c_res'>$d4_c_res</p>";
echo "<p id='d4_street_num'>$d4_street_num</p>";
echo "<p id='d4_street_name'>$d4_street_name</p>";
echo "<p id='d4_suite'>$d4_suite</p>";
echo "<p id='d4_city'>$d4_city</p>";
echo "<p id='d4_province'>$d4_province</p>";
echo "<p id='d4_country'>$d4_country</p>";
echo "<p id='d4_postal_code'>$d4_postal_code</p>";

echo "<p id='d5_first'>$d5_first</p>";
echo "<p id='d5_middle'>$d5_middle</p>";
echo "<p id='d5_last'>$d5_last</p>";
echo "<p id='d5_c_res'>$d5_c_res</p>";
echo "<p id='d5_street_num'>$d5_street_num</p>";
echo "<p id='d5_street_name'>$d5_street_name</p>";
echo "<p id='d5_suite'>$d5_suite</p>";
echo "<p id='d5_city'>$d5_city</p>";
echo "<p id='d5_province'>$d5_province</p>";
echo "<p id='d5_country'>$d5_country</p>";
echo "<p id='d5_postal_code'>$d5_postal_code</p>";

echo "<p id='num_incorporators'>$num_incorporators</p>";

echo "<p id='i1_first'>$i1_first</p>";
echo "<p id='i1_middle'>$i1_middle</p>";
echo "<p id='i1_last'>$i1_last</p>";
echo "<p id='i1_c_res'>$i1_c_res</p>";
echo "<p id='i1_street_num'>$i1_street_num</p>";
echo "<p id='i1_street_name'>$i1_street_name</p>";
echo "<p id='i1_suite'>$i1_suite</p>";
echo "<p id='i1_city'>$i1_city</p>";
echo "<p id='i1_province'>$i1_province</p>";
echo "<p id='i1_country'>$i1_country</p>";
echo "<p id='i1_postal_code'>$i1_postal_code</p>";

echo "<p id='i2_first'>$i2_first</p>";
echo "<p id='i2_middle'>$i2_middle</p>";
echo "<p id='i2_last'>$i2_last</p>";
echo "<p id='i2_c_res'>$i2_c_res</p>";
echo "<p id='i2_street_num'>$i2_street_num</p>";
echo "<p id='i2_street_name'>$i2_street_name</p>";
echo "<p id='i2_suite'>$i2_suite</p>";
echo "<p id='i2_city'>$i2_city</p>";
echo "<p id='i2_province'>$i2_province</p>";
echo "<p id='i2_country'>$i2_country</p>";
echo "<p id='i2_postal_code'>$i2_postal_code</p>";

echo "<p id='i3_first'>$i3_first</p>";
echo "<p id='i3_middle'>$i3_middle</p>";
echo "<p id='i3_last'>$i3_last</p>";
echo "<p id='i3_c_res'>$i3_c_res</p>";
echo "<p id='i3_street_num'>$i3_street_num</p>";
echo "<p id='i3_street_name'>$i3_street_name</p>";
echo "<p id='i3_suite'>$i3_suite</p>";
echo "<p id='i3_city'>$i3_city</p>";
echo "<p id='i3_province'>$i3_province</p>";
echo "<p id='i3_country'>$i3_country</p>";
echo "<p id='i3_postal_code'>$i3_postal_code</p>";

echo "<p id='i4_first'>$i4_first</p>";
echo "<p id='i4_middle'>$i4_middle</p>";
echo "<p id='i4_last'>$i4_last</p>";
echo "<p id='i4_c_res'>$i4_c_res</p>";
echo "<p id='i4_street_num'>$i4_street_num</p>";
echo "<p id='i4_street_name'>$i4_street_name</p>";
echo "<p id='i4_suite'>$i4_suite</p>";
echo "<p id='i4_city'>$i4_city</p>";
echo "<p id='i4_province'>$i4_province</p>";
echo "<p id='i4_country'>$i4_country</p>";
echo "<p id='i4_postal_code'>$i4_postal_code</p>";

echo "<p id='i5_first'>$i5_first</p>";
echo "<p id='i5_middle'>$i5_middle</p>";
echo "<p id='i5_last'>$i5_last</p>";
echo "<p id='i5_c_res'>$i5_c_res</p>";
echo "<p id='i5_street_num'>$i5_street_num</p>";
echo "<p id='i5_street_name'>$i5_street_name</p>";
echo "<p id='i5_suite'>$i5_suite</p>";
echo "<p id='i5_city'>$i5_city</p>";
echo "<p id='i5_province'>$i5_province</p>";
echo "<p id='i5_country'>$i5_country</p>";
echo "<p id='i5_postal_code'>$i5_postal_code</p>";

echo "<p id='existing_corp_name'>$existing_corp_name</p>";
echo "<p id='existing_corp_number'>$existing_corp_number</p>";
echo "<p id='business_activity'>$business_activity</p>";
echo "<p id='products_services_provided'>$products_services_provided</p>";
echo "<p id='operate_in_ontario'>$operate_in_ontario</p>";
echo "<p id='hire_employees'>$hire_employees</p>";
echo "<p id='annual_payroll'>$annual_payroll</p>";
echo "<p id='eht_number'>$eht_number</p>";
echo "<p id='hire_contractors'>$hire_contractors</p>";
echo "<p id='hire_date'>$hire_date</p>";
echo "<p id='wsib_account'>$wsib_account</p>";
echo "<p id='personal_wsib'>$personal_wsib</p>";
echo "<p id='business_phone'>$business_phone</p>";
echo "<p id='same_as_business'>$same_as_business</p>";

echo "<p id='i2_phone'>$i2_phone</p>";
echo "<p id='d1_phone'>$d1_phone</p>";
echo "<p id='d2_phone'>$d2_phone</p>";
echo "<p id='d3_phone'>$d3_phone</p>";
echo "<p id='d4_phone'>$d4_phone</p>";
echo "<p id='d5_phone'>$d5_phone</p>";
echo "<p id='i3_phone'>$i3_phone</p>";

echo "<p id='contact_first'>$contact_first</p>";
echo "<p id='contact_last'>$contact_last</p>";
echo "<p id='contact_st_num'>$contact_st_num</p>";
echo "<p id='contact_st_name'>$contact_st_name</p>";
echo "<p id='contact_city'>$contact_city</p>";
echo "<p id='contact_province'>$contact_province</p>";
echo "<p id='contact_country'>$contact_country</p>";
echo "<p id='contact_postal'>$contact_postal</p>";
echo "<p id='contact_phone'>$contact_phone</p>";
echo "<p id='consent_first'>$consent_first</p>";
echo "<p id='consent_last'>$consent_last</p>";

echo "<p id='review_status'>$review_status</p>";

echo "<p id='site_source'>$site</p>";

echo "<p id='reservation_date'>$reservation_date</p>";
echo "<p id='primary_business_activity'>$primary_business_activity</p>";
echo "<p id='official_email'>$official_email</p>";
?>
