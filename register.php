<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dev"; // ชื่อฐานข้อมูลที่เชื่อมต่อ

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname, 8889);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // ใช้คำสั่ง SQL ในการเพิ่มข้อมูล
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";

    // ตรวจสอบการดำเนินการ
    if ($conn->query($sql) === TRUE) {
        header("Location: index.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
