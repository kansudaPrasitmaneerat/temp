<?php
$servername = "localhost";  // ใช้ localhost
$username = "root";         // ค่าเริ่มต้นของ MAMP สำหรับ MySQL
$password = "root";         // รหัสผ่านเริ่มต้นสำหรับ MAMP
$dbname = "dev";    // ชื่อฐานข้อมูลที่ต้องการเชื่อมต่อ

// สร้างการเชื่อมต่อ โดยระบุพอร์ต 8889 สำหรับ MySQL
$conn = new mysqli($servername, $username, $password, $dbname, 8889);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!";
}
?>
