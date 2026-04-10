<?php

// Database connection
$host = 'localhost';
$db_name = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Create table if not exists
$sql = "CREATE TABLE IF NOT EXISTS momo_payments (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    transaction_id VARCHAR(100) NOT NULL,
    payment_type VARCHAR(50) NOT NULL,
    description TEXT,
    date DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->exec($sql);

// CRUD operations

// GET endpoint
function getPayments() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM momo_payments");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// POST endpoint
function createPayment($data) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO momo_payments (name, phone_number, amount, transaction_id, payment_type, description, date) VALUES (:name, :phone_number, :amount, :transaction_id, :payment_type, :description, :date)");
    return $stmt->execute($data);
}

// PUT endpoint
function updatePayment($id, $data) {
    global $conn;
    $stmt = $conn->prepare("UPDATE momo_payments SET name = :name, phone_number = :phone_number, amount = :amount, transaction_id = :transaction_id, payment_type = :payment_type, description = :description, date = :date WHERE id = :id");
    $data['id'] = $id;
    return $stmt->execute($data);
}

// DELETE endpoint
function deletePayment($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM momo_payments WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}

?>