<?php
// Authenticate API key
// API key may come from ?key= in the query string or X-API-KEY header
$providedKey = $_GET['key'] ?? ($_SERVER['HTTP_X_API_KEY'] ?? '');
if ($providedKey !== ($_ENV['ORDER_API_KEY'] ?? '')) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$columnMappings = [
  'ont_inc' => [
  // Contact Info
  'contact_first'        => 'contact_first_name',
  'contact_last'         => 'contact_last_name',
  'contact_phone'        => 'contact_phone_number',

  // Company Name & NUANS
  'Cname'                => 'company_name',
  'type_of_company'      => 'company_type', // e.g. "Numbered Company"
  'legal_ending'         => 'legal_ending',
  'reservation_number'   => 'nuans_reservation_number',
  'reservation_date'     => 'nuans_reservation_date',

  // General Details
  'primary_business_activity' => 'primary_business_activity',
  'official_email'       => 'official_email_address',

  // Office Address
  'postal_code'          => 'registered_office_postal_code',
  'street_num'           => 'registered_office_street_number',
  'street_name'          => 'registered_office_street_name',
  'suite'                => 'registered_office_suite',
  'city'                 => 'registered_office_city',

  // Director Counts
  'req_num_directors'    => 'director_number_type',     // Fixed Number or Range
  'fixed_num_directors'  => 'number_of_directors_fixed',
  'range_from_directors' => 'number_of_directors_min',
  'range_to_directors'   => 'number_of_directors_max',

  // Director Info (1–5)
  'd1_first' => 'director_1_first_name',
  'd1_middle' => 'director_1_middle_name',
  'd1_last' => 'director_1_last_name',
  'd1_postal_code' => 'director_1_postal_code',
  'd1_c_res' => 'director_1_canadian_resident',
  'd1_street_name' => 'director_1_street_name',
  'd1_street_num' => 'director_1_street_number',
  'd1_suite' => 'director_1_suite',
  'd1_city' => 'director_1_city',

  'd2_first' => 'director_2_first_name',
  'd2_middle' => 'director_2_middle_name',
  'd2_last' => 'director_2_last_name',
  'd2_postal_code' => 'director_2_postal_code',
  'd2_c_res' => 'director_2_canadian_resident',
  'd2_street_name' => 'director_2_street_name',
  'd2_street_num' => 'director_2_street_number',
  'd2_suite' => 'director_2_suite',
  'd2_city' => 'director_2_city',

  'd3_first' => 'director_3_first_name',
  'd3_middle' => 'director_3_middle_name',
  'd3_last' => 'director_3_last_name',
  'd3_postal_code' => 'director_3_postal_code',
  'd3_c_res' => 'director_3_canadian_resident',
  'd3_street_name' => 'director_3_street_name',
  'd3_street_num' => 'director_3_street_number',
  'd3_suite' => 'director_3_suite',
  'd3_city' => 'director_3_city',

  'd4_first' => 'director_4_first_name',
  'd4_middle' => 'director_4_middle_name',
  'd4_last' => 'director_4_last_name',
  'd4_postal_code' => 'director_4_postal_code',
  'd4_c_res' => 'director_4_canadian_resident',
  'd4_street_name' => 'director_4_street_name',
  'd4_street_num' => 'director_4_street_number',
  'd4_suite' => 'director_4_suite',
  'd4_city' => 'director_4_city',

  'd5_first' => 'director_5_first_name',
  'd5_middle' => 'director_5_middle_name',
  'd5_last' => 'director_5_last_name',
  'd5_postal_code' => 'director_5_postal_code',
  'd5_c_res' => 'director_5_canadian_resident',
  'd5_street_name' => 'director_5_street_name',
  'd5_street_num' => 'director_5_street_number',
  'd5_suite' => 'director_5_suite',
  'd5_city' => 'director_5_city',

  // Share Structure
  'a_share_structure' => 'share_structure_type',
  'share_structure'   => 'share_structure_text',

  // Share Rights & Privileges
  'b_rights_priv' => 'share_rights_type',
  'rights_priv'   => 'share_rights_text',

  // Share Transfer Restrictions
  'c_restrictions' => 'share_transfer_type',
  'restrictions'   => 'share_transfer_text',

  // Activity Limitations
  'd_limitations'  => 'business_activity_limitations_type',
  'limitations'    => 'business_activity_limitations_text',

  // Other Provisions
  'e_other_provisions' => 'other_provisions_type',
  'other_provisions'   => 'other_provisions_text',

  // Incorporators (1–5)
  'i1_first' => 'incorporator_1_first_name',
  'i1_middle' => 'incorporator_1_middle_name',
  'i1_last' => 'incorporator_1_last_name',
  'i1_postal_code' => 'incorporator_1_postal_code',
  'i1_street_name' => 'incorporator_1_street_name',
  'i1_street_num' => 'incorporator_1_street_number',
  'i1_suite' => 'incorporator_1_suite',
  'i1_city' => 'incorporator_1_city',

  'i2_first' => 'incorporator_2_first_name',
  'i2_middle' => 'incorporator_2_middle_name',
  'i2_last' => 'incorporator_2_last_name',
  'i2_postal_code' => 'incorporator_2_postal_code',
  'i2_street_name' => 'incorporator_2_street_name',
  'i2_street_num' => 'incorporator_2_street_number',
  'i2_suite' => 'incorporator_2_suite',
  'i2_city' => 'incorporator_2_city',

  'i3_first' => 'incorporator_3_first_name',
  'i3_middle' => 'incorporator_3_middle_name',
  'i3_last' => 'incorporator_3_last_name',
  'i3_postal_code' => 'incorporator_3_postal_code',
  'i3_street_name' => 'incorporator_3_street_name',
  'i3_street_num' => 'incorporator_3_street_number',
  'i3_suite' => 'incorporator_3_suite',
  'i3_city' => 'incorporator_3_city',

  'i4_first' => 'incorporator_4_first_name',
  'i4_middle' => 'incorporator_4_middle_name',
  'i4_last' => 'incorporator_4_last_name',
  'i4_postal_code' => 'incorporator_4_postal_code',
  'i4_street_name' => 'incorporator_4_street_name',
  'i4_street_num' => 'incorporator_4_street_number',
  'i4_suite' => 'incorporator_4_suite',
  'i4_city' => 'incorporator_4_city',

  'i5_first' => 'incorporator_5_first_name',
  'i5_middle' => 'incorporator_5_middle_name',
  'i5_last' => 'incorporator_5_last_name',
  'i5_postal_code' => 'incorporator_5_postal_code',
  'i5_street_name' => 'incorporator_5_street_name',
  'i5_street_num' => 'incorporator_5_street_number',
  'i5_suite' => 'incorporator_5_suite',
  'i5_city' => 'incorporator_5_city',

  // Misc
  'orderNum' => 'order_number'
],
  'm_business' => [
  // Contact / Presenter
  'consent_first'     => 'presenter_first_name',
  'consent_last'      => 'presenter_last_name',
  'contact_first'     => 'presenter_first_name', // used in Operating Name
  'contact_last'      => 'presenter_last_name',
  'contact_phone'     => 'presenter_phone_number',

  // Business Name
  'Cname'             => 'business_name',

  // Business Details
  'primary_business_activity' => 'primary_business_activity',
  'official_email'    => 'official_email_address',
  'type_of_company'   => 'business_structure_type', // Sole Proprietorship, Partnership, etc.
  'tor'               => 'type_of_registration',     // New Registration, Renewal

  // Address (Business / Registered)
  'postal_code'       => 'business_postal_code',
  'street_num'        => 'business_street_number',
  'street_name'       => 'business_street_name',
  'suite'             => 'business_suite',
  'city'              => 'business_city',

  // Owner (Sole Prop) or Partner (GP)
  'i2_first'          => 'owner_first_name',
  'i2_middle'         => 'owner_middle_name',
  'i2_last'           => 'owner_last_name',
  'i2_postal_code'    => 'owner_postal_code',
  'i2_street_num'     => 'owner_street_number',
  'i2_street_name'    => 'owner_street_name',
  'i2_suite'          => 'owner_suite',
  'i2_city'           => 'owner_city',

  // General Partnership – up to 5 partners
  'd1_first' => 'partner_1_first_name',
  'd1_middle' => 'partner_1_middle_name',
  'd1_last' => 'partner_1_last_name',
  'd1_postal_code' => 'partner_1_postal_code',
  'd1_street_num' => 'partner_1_street_number',
  'd1_street_name' => 'partner_1_street_name',
  'd1_suite' => 'partner_1_suite',
  'd1_city' => 'partner_1_city',

  'd2_first' => 'partner_2_first_name',
  'd2_middle' => 'partner_2_middle_name',
  'd2_last' => 'partner_2_last_name',
  'd2_postal_code' => 'partner_2_postal_code',
  'd2_street_num' => 'partner_2_street_number',
  'd2_street_name' => 'partner_2_street_name',
  'd2_suite' => 'partner_2_suite',
  'd2_city' => 'partner_2_city',

  'd3_first' => 'partner_3_first_name',
  'd3_middle' => 'partner_3_middle_name',
  'd3_last' => 'partner_3_last_name',
  'd3_postal_code' => 'partner_3_postal_code',
  'd3_street_num' => 'partner_3_street_number',
  'd3_street_name' => 'partner_3_street_name',
  'd3_suite' => 'partner_3_suite',
  'd3_city' => 'partner_3_city',

  'd4_first' => 'partner_4_first_name',
  'd4_middle' => 'partner_4_middle_name',
  'd4_last' => 'partner_4_last_name',
  'd4_postal_code' => 'partner_4_postal_code',
  'd4_street_num' => 'partner_4_street_number',
  'd4_street_name' => 'partner_4_street_name',
  'd4_suite' => 'partner_4_suite',
  'd4_city' => 'partner_4_city',

  'd5_first' => 'partner_5_first_name',
  'd5_middle' => 'partner_5_middle_name',
  'd5_last' => 'partner_5_last_name',
  'd5_postal_code' => 'partner_5_postal_code',
  'd5_street_num' => 'partner_5_street_number',
  'd5_street_name' => 'partner_5_street_name',
  'd5_suite' => 'partner_5_suite',
  'd5_city' => 'partner_5_city',

  // Operating Name – linked corp
  'existinc_corp_name'   => 'existing_corporation_name',
  'existing_corp_number' => 'existing_corporation_number',

  // Officer / Authorization
  'i3_first'         => 'officer_first_name',
  'i3_middle'        => 'officer_middle_name',
  'i3_last'          => 'officer_last_name',
  'i3_postal_code'   => 'officer_postal_code',
  'i3_street_num'    => 'officer_street_number',
  'i3_street_name'   => 'officer_street_name',
  'i3_suite'         => 'officer_suite',
  'i3_city'          => 'officer_city',
  'i3_phone'         => 'officer_phone_number',

  // Other
  'orderNum'         => 'order_number',
  'num_first_directors' => 'number_of_partners', // for general partnerships
]
];

function applyColumnMapping(array $row, string $type, array $mappings): array {
    if (!isset($mappings[$type])) {
        return $row; // fallback
    }
    $map = $mappings[$type];
    $result = [];
    foreach ($row as $key => $value) {
        $result[$map[$key] ?? $key] = $value;
    }
    return $result;
}

$mysql_db_hostname = $_ENV['DB_HOST'];
$mysql_db_user = $_ENV['DB_USER'];
$mysql_db_password = $_ENV['DB_PASS'];
$mysql_db_database = $_ENV['DB_DATA'];
$mysql_db_port     = isset($_ENV['DB_PORT']) ? (int)$_ENV['DB_PORT'] : 3306;

$conn = new mysqli($mysql_db_hostname, $mysql_db_user, $mysql_db_password, $mysql_db_database, $mysql_db_port);
if ($conn->connect_error) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // specify an order ID to bypass status checks
if ($id > 0) {
    $sql = "SELECT * FROM orders WHERE id=$id LIMIT 1";
} else {
    $sql = "select * from orders WHERE status!='pending' AND status!='review' AND status!='completed' ORDER BY id ASC limit 1";
}

$result = $conn->query($sql);
if (!$result) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Query failed']);
    exit;
}

$row = $result->fetch_assoc();
if (!$row) {
    header('Content-Type: application/json');
    echo json_encode(['message' => 'No orders found']);
    exit;
}

$type_check = $row['type'];
$missingInfo = false;
if ($type_check === 'ont_inc') {
    $required = [
        'contact_first', 'contact_last', 'contact_st_num', 'contact_city',
        'contact_province', 'contact_country', 'contact_postal', 'contact_phone',
        'consent_first', 'consent_last'
    ];
    foreach ($required as $field) {
        if (trim($row[$field]) === '') {
            $missingInfo = true;
            break;
        }
    }
} elseif ($type_check === 'm_business') {
    if (trim($row['consent_last']) === '') {
        $missingInfo = true;
    }
}

if ($missingInfo) {
    $data_id = $row['id'];
    $data_on = $row['order_number'];
    $data_key = $row['order_time'];
    $data_e = $row['email'];
    $data_name = $row['name'];
    $data_Cname = $row['cust_name'];

    $from = "Opstart <orders@opstartnotifications.com>";
    $to = $data_e;
    $subject = "Additional Details Required - $data_name";
    if ($type_check === 'ont_inc') {
        $body = "Hi $data_Cname,<br/><br/>Additional information is required to process your Ontario Incorporation.<br/><br/><a href='https://updates.opstart.ca/ontario-incorporation-review-and-submit/?on=$data_on&k=$data_key&e=$data_e'>Click Here to submit the necessary information.</a><br/><br/>Once we receive the requested information we can proceed with your Ontario Incorporation.<br/><br/>Thanks.<br/><br/>- The Opstart Team";
    } elseif ($type_check === 'm_business') {
        $body = "Hi $data_Cname,<br/><br/>Additional information is required to process your Business Registration.<br/><br/><a href='https://updates.opstart.ca/master-business-licence-verification/?on=$data_on&k=$data_key&e=$data_e'>Click Here to submit the necessary information.</a><br/><br/>Once we receive the requested information we can proceed with your Business Registration.<br/><br/>Thanks.<br/><br/>- The Opstart Team";
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/opstartnotifications.com/messages');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    $post = [
        'from' => $from,
        'to' => $to,
        'subject' => $subject,
        'html' => $body
    ];
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_USERPWD, 'api:' . $_ENV['MAILGUN_API_KEY']);
    curl_exec($ch);
    curl_close($ch);

    $conn->query("Update orders SET status='pending' WHERE id='$data_id'");

    header('Content-Type: application/json');
    echo json_encode(['message' => 'Information request sent']);
    exit;
}

$mappedRow = applyColumnMapping($row, $type_check, $columnMappings);
header('Content-Type: application/json');
echo json_encode($mappedRow);
?>
