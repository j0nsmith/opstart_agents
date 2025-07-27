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

header('Content-Type: application/json');
echo json_encode($row);
?>
