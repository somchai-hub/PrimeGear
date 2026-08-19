<?php
session_start();

// ตรวจสอบว่าแอดมินล็อกอินหรือยัง (มี Session หรือไม่)
// หากยังไม่ได้ล็อกอิน ให้เด้งกลับไปหน้า login
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin/admin_login.php");
    exit();
}

// จำลองชื่อแอดมินที่ล็อกอินเข้ามา
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แผงควบคุม | PrimeGear Admin</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Prompt', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden text-gray-800">

    <!-- 1. Sidebar (เมนูด้านซ้าย) -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0 transition-all duration-300">
        <!-- Logo Area -->
        <div class="h-16 flex items-center px-6 bg-gray-950 border-b border-gray-800">
            <a href="dashboard.php" class="text-xl font-bold text-blue-400 flex items-center">
                <i class="fa-solid fa-bolt mr-2 text-yellow-400"></i> PrimeGear
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <p class="px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">เมนูหลัก</p>
            
            <!-- Active Menu -->
            <a href="dashboard.php" class="flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg">
                <i class="fa-solid fa-chart-pie w-5 mr-3"></i> แผงควบคุม (Dashboard)
            </a>
            
            <!-- Inactive Menus -->
            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
                <i class="fa-solid fa-box w-5 mr-3"></i> จัดการสินค้า (Products)
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
                <i class="fa-solid fa-mobile-screen-button w-5 mr-3"></i> จัดการอุปกรณ์ (Devices)
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
                <i class="fa-solid fa-link w-5 mr-3"></i> ความเข้ากันได้ (Compatibility)
            </a>
        </nav>

        <!-- User & Logout -->
        <div class="p-4 bg-gray-950 border-t border-gray-800">
            <div class="flex items-center mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-sm font-bold mr-3">
                    <?php echo strtoupper(substr($admin_name, 0, 1)); ?>
                </div>
                <div>
                    <p class="text-sm font-medium"><?php echo $admin_name; ?></p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
            <!-- ปุ่มออกจากระบบ (สมมติว่าลิงก์ไปหน้า logout.php) -->
            <a href="admin_login.php" onclick="alert('จำลองการออกจากระบบ ล้าง Session')" class="flex items-center justify-center w-full px-4 py-2 text-sm text-red-400 hover:bg-gray-800 rounded-lg transition-colors border border-gray-800 hover:border-red-900">
                <i class="fa-solid fa-right-from-bracket mr-2"></i> ออกจากระบบ
            </a>
        </div>
    </aside>

    <!-- 2. Main Content (พื้นที่แสดงผลด้านขวา) -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- Top Bar -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8 z-10">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold text-gray-800">ภาพรวมระบบ (Overview)</h2>
            </div>
            <div class="flex items-center space-x-4">
                <!-- ช่องค้นหา -->
                <div class="relative">
                    <input type="text" placeholder="ค้นหารหัสคำสั่งซื้อ..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button class="text-gray-500 hover:text-blue-600 relative">
                    <i class="fa-solid fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center">3</span>
                </button>
            </div>
        </header>

        <!-- Dashboard Content (เลื่อน Scroll ได้) -->
        <main class="flex-1 overflow-y-auto p-8">
            
            <!-- 2.1 Summary Cards (การ์ดสรุปข้อมูล) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="w-14 h-14 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mr-4">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">ยอดขายวันนี้</p>
                        <h3 class="text-2xl font-bold text-gray-900">฿ 15,400</h3>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="w-14 h-14 rounded-lg bg-green-50 text-green-600 flex items-center justify-center text-2xl mr-4">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">คำสั่งซื้อใหม่</p>
                        <h3 class="text-2xl font-bold text-gray-900">24 <span class="text-sm font-normal text-gray-500">รายการ</span></h3>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="w-14 h-14 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center text-2xl mr-4">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">สินค้าทั้งหมด</p>
                        <h3 class="text-2xl font-bold text-gray-900">128 <span class="text-sm font-normal text-gray-500">ชิ้น</span></h3>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="w-14 h-14 rounded-lg bg-red-50 text-red-600 flex items-center justify-center text-2xl mr-4">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">สินค้าใกล้หมดสต๊อก</p>
                        <h3 class="text-2xl font-bold text-gray-900">5 <span class="text-sm font-normal text-gray-500">รายการ</span></h3>
                    </div>
                </div>
            </div>

            <!-- 2.2 Tables Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- ตารางคำสั่งซื้อล่าสุด (กินพื้นที่ 2 ส่วน) -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-800">คำสั่งซื้อล่าสุด</h3>
                        <a href="#" class="text-sm text-blue-600 hover:underline">ดูทั้งหมด</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-white text-gray-500 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-3 font-medium">รหัสสั่งซื้อ</th>
                                    <th class="px-6 py-3 font-medium">ลูกค้า</th>
                                    <th class="px-6 py-3 font-medium">ยอดรวม</th>
                                    <th class="px-6 py-3 font-medium">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">#ORD-00123</td>
                                    <td class="px-6 py-4">สมชาย ใจดี</td>
                                    <td class="px-6 py-4">฿ 1,290</td>
                                    <td class="px-6 py-4"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-medium">รอชำระเงิน</span></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">#ORD-00122</td>
                                    <td class="px-6 py-4">วิภาวรรณ รักเรียน</td>
                                    <td class="px-6 py-4">฿ 890</td>
                                    <td class="px-6 py-4"><span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">กำลังจัดส่ง</span></td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">#ORD-00121</td>
                                    <td class="px-6 py-4">John Doe</td>
                                    <td class="px-6 py-4">฿ 2,580</td>
                                    <td class="px-6 py-4"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">สำเร็จ</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- สินค้าใกล้หมดสต๊อก (กินพื้นที่ 1 ส่วน) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h3 class="font-bold text-gray-800">สินค้าใกล้หมด <i class="fa-solid fa-fire text-red-500 ml-1"></i></h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-4">
                            <li class="flex justify-between items-center border-b border-gray-50 pb-3">
                                <div>
                                    <p class="font-medium text-sm text-gray-900">Armor Case Pro (iPhone 15)</p>
                                    <p class="text-xs text-gray-500">เคสกันกระแทก</p>
                                </div>
                                <span class="bg-red-100 text-red-700 font-bold px-2 py-1 rounded text-xs">เหลือ 2 ชิ้น</span>
                            </li>
                            <li class="flex justify-between items-center border-b border-gray-50 pb-3">
                                <div>
                                    <p class="font-medium text-sm text-gray-900">Tough Braided C to C</p>
                                    <p class="text-xs text-gray-500">สายชาร์จ</p>
                                </div>
                                <span class="bg-red-100 text-red-700 font-bold px-2 py-1 rounded text-xs">เหลือ 4 ชิ้น</span>
                            </li>
                        </ul>
                        <button class="w-full mt-4 text-sm text-blue-600 font-medium hover:underline">จัดการสต๊อกสินค้า</button>
                    </div>
                </div>

            </div>

        </main>
    </div>

</body>
</html>