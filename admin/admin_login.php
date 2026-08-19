<?php
session_start();
require '../process/client.php';

$error_msg = "";

// ตรวจสอบว่ามีการกดปุ่ม Submit (POST) หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_input = trim($_POST['username']); // รับค่าจากฟอร์ม
    $pass_input = trim($_POST['password']);

    // ใช้ Prepared Statement เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare("SELECT Admin_ID, username, password FROM admin WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $user_input, $user_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // ตรวจสอบรหัสผ่านที่เข้ารหัสไว้
        if (password_verify($pass_input, $row['password'])) {
            // เข้าสู่ระบบสำเร็จ -> สร้าง Session
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_name'] = $row['username'];
            
            // ส่งไปหน้า Dashboard
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error_msg = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error_msg = "ไม่พบชื่อผู้ใช้งานหรืออีเมลนี้ในระบบ";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบจัดการหลังบ้าน | PrimeGear Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Prompt', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="h-2 w-full bg-blue-600"></div>
        
        <div class="p-8">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-4">
                    <i class="fa-solid fa-bolt text-3xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">PrimeGear Admin</h1>
                <p class="text-gray-500 text-sm mt-2">เข้าสู่ระบบเพื่อจัดการระบบหลังบ้าน</p>
            </div>

            <!-- แสดงข้อความ Error หากล็อกอินไม่สำเร็จ -->
            <?php if (!empty($error_msg)): ?>
                <div class="bg-red-50 text-red-600 border border-red-200 text-sm px-4 py-3 rounded-lg mb-6 flex items-center">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i> <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <!-- ฟอร์มเข้าสู่ระบบ (ส่งข้อมูลแบบ POST เข้าหาไฟล์ตัวเอง) -->
            <form action="admin_login.php" method="POST" class="space-y-6">
                
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">ชื่อผู้ใช้งาน หรือ อีเมล</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-regular fa-user text-gray-400"></i>
                        </div>
                        <!-- เพิ่ม name="username" เพื่อส่งข้อมูลให้ PHP -->
                        <input type="text" id="username" name="username" required 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm" 
                            placeholder="admin@primegear.com">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">รหัสผ่าน</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                        </div>
                        <!-- เพิ่ม name="password" เพื่อส่งข้อมูลให้ PHP -->
                        <input type="password" id="password" name="password" required 
                            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm" 
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                    เข้าสู่ระบบ
                </button>
            </form>
            
        </div>
    </div>

</body>
</html>