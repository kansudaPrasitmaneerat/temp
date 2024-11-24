<?php
$servername = "localhost";
$username = "root"; // ชื่อผู้ใช้ MySQL
$password = "root"; // รหัสผ่าน MySQL
$dbname = "dev";  // ใช้ฐานข้อมูล dev

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname, 8889);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username']; // รับค่าจากฟอร์ม
    $pass = $_POST['password']; // รับค่าจากฟอร์ม

    // คำสั่ง SQL เพื่อค้นหาผู้ใช้จากชื่อผู้ใช้
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);  // ผูกตัวแปร username กับคำสั่ง SQL
    $stmt->execute();
    $stmt->store_result();

    // ตรวจสอบว่าพบผู้ใช้หรือไม่
    if ($stmt->num_rows > 0) {
        // ผู้ใช้พบแล้ว, ตรวจสอบรหัสผ่าน
        $stmt->bind_result($db_password); // รับค่ารหัสผ่านจากฐานข้อมูล
        $stmt->fetch(); // ดึงค่าผลลัพธ์จากฐานข้อมูล

        // เปรียบเทียบรหัสผ่านที่กรอกกับรหัสผ่านในฐานข้อมูล
        if ($pass === $db_password) {
            header("Location: home.html");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No user found!";
    }
    
    $stmt->close();
}

$conn->close();
?>
