<?php
// Set your secret API key (or pull from ENV for better security)
$validApiKey = $_ENV['OBR_CREDENTIALS_API_KEY'] ?? '4f7c2c6d8e3f1a9b5e67102cd3a4b6f1';

// Get API key from Authorization header
function getBearerToken() {
    $headers = getallheaders();
    if (isset($headers['Authorization'])) {
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            return $matches[1];
        }
    }
    return null;
}

$providedApiKey = getBearerToken() ?? ($_GET['api_key'] ?? null);

if ($providedApiKey !== $validApiKey) {
    http_response_code(401);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Only allow GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    header('Allow: GET');
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// Retrieve credentials from ENV
$username = $_ENV['OBR_USER'] ?? null;
$password = $_ENV['OBR_PASS'] ?? null;

if (!$username || !$password) {
    http_response_code(500);
    echo json_encode(['error' => 'Missing credentials in environment']);
    exit;
}

// Return credentials as JSON
header('Content-Type: application/json');
echo json_encode([
    'username' => $username,
    'password' => $password
]);
