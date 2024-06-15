<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "expenses_db";


// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO expenses (date, category, description, amount) VALUES ('$date', '$category', '$description', '$amount')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Rekaman baru berhasil dibuat"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error]);
    }

    $conn->close();
}
?>
