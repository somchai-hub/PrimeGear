<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าความเข้ากันได้ | Admin PrimeGear</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Prompt', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Admin Navbar -->
    <nav class="bg-gray-900 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-4">
                    <a href="admin_products.php" class="text-xl font-bold text-blue-400">
                        <i class="fa-solid fa-screwdriver-wrench"></i> Admin Panel
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-300"><i class="fa-solid fa-user-shield mr-2"></i>ผู้ดูแลระบบ</span>
                    <a href="logout.php" class="text-red-400 hover:text-red-300 text-sm"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                <a href="admin_products.php" class="hover:text-blue-600">จัดการอุปกรณ์</a>
                <span><i class="fa-solid fa-chevron-right text-xs"></i></span>
                <span class="text-gray-900 font-medium">ตั้งค่าความเข้ากันได้</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900"><i class="fa-solid fa-link text-blue-600 mr-2"></i>ตั้งค่าความเข้ากันได้ (Compatibility)</h1>
            <p class="text-sm text-gray-500 mt-1">จัดการตัวเลือก แบรนด์ รุ่น และพอร์ตเชื่อมต่อ เพื่อนำไปใช้เป็นตัวเลือกตอนเพิ่มอุปกรณ์ใหม่</p>
        </div>

        <!-- Settings Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- หมวดหมู่: แบรนด์ (Brands) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col h-full">
                <div class="p-5 border-b border-gray-100 bg-gray-50 rounded-t-xl">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fa-solid fa-copyright text-gray-400 w-6"></i> แบรนด์ (Brands)
                    </h2>
                </div>
                <div class="p-5 flex-1">
                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                            Apple
                            <button class="ml-2 text-blue-500 hover:text-blue-900 focus:outline-none"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                            Samsung
                            <button class="ml-2 text-blue-500 hover:text-blue-900 focus:outline-none"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 border border-gray-200">
                            Universal
                            <button class="ml-2 text-gray-500 hover:text-gray-900 focus:outline-none"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                    </div>
                </div>
                <!-- Input for new tag -->
                <div class="p-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                    <form action="#" method="POST" class="flex space-x-2">
                        <input type="text" placeholder="เพิ่มแบรนด์ใหม่..." class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                        <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">เพิ่ม</button>
                    </form>
                </div>
            </div>

            <!-- หมวดหมู่: รุ่นอุปกรณ์ (Device Models) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col h-full">
                <div class="p-5 border-b border-gray-100 bg-gray-50 rounded-t-xl">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fa-solid fa-mobile-screen-button text-gray-400 w-6"></i> รุ่นอุปกรณ์ (Models)
                    </h2>
                </div>
                <div class="p-5 flex-1">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 border border-purple-200">
                            iPhone 15 Pro Max
                            <button class="ml-2 text-purple-500 hover:text-purple-900"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 border border-purple-200">
                            iPhone 15 Pro
                            <button class="ml-2 text-purple-500 hover:text-purple-900"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 border border-purple-200">
                            Galaxy S24 Ultra
                            <button class="ml-2 text-purple-500 hover:text-purple-900"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                    </div>
                </div>
                <div class="p-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                    <form action="#" method="POST" class="flex space-x-2">
                        <input type="text" placeholder="เพิ่มรุ่นใหม่..." class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                        <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">เพิ่ม</button>
                    </form>
                </div>
            </div>

            <!-- หมวดหมู่: ประเภทพอร์ตเชื่อมต่อ (Connector Types) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 flex flex-col h-full">
                <div class="p-5 border-b border-gray-100 bg-gray-50 rounded-t-xl">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fa-solid fa-plug text-gray-400 w-6"></i> พอร์ตเชื่อมต่อ (Connectors)
                    </h2>
                </div>
                <div class="p-5 flex-1">
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                            USB-C
                            <button class="ml-2 text-emerald-500 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                            Lightning
                            <button class="ml-2 text-emerald-500 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                            Wireless (Qi)
                            <button class="ml-2 text-emerald-500 hover:text-emerald-900"><i class="fa-solid fa-xmark"></i></button>
                        </span>
                    </div>
                </div>
                <div class="p-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
                    <form action="#" method="POST" class="flex space-x-2">
                        <input type="text" placeholder="เพิ่มประเภทพอร์ต..." class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                        <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">เพิ่ม</button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Section: สรุปการจับคู่ (Mapping Overview) - ออฟชั่นเสริม -->
        <div class="mt-10 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-5 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">สรุปภาพรวมอุปกรณ์ในระบบ</h3>
                <p class="text-sm text-gray-500 mt-1">แสดงจำนวนสินค้าที่ถูกแท็กในแต่ละการตั้งค่าความเข้ากันได้</p>
            </div>
            <div class="p-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-3xl font-bold text-blue-600 mb-1">12</div>
                    <div class="text-sm font-medium text-gray-600">สินค้ารองรับ Apple</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-3xl font-bold text-purple-600 mb-1">8</div>
                    <div class="text-sm font-medium text-gray-600">เคสสำหรับ iPhone 15 Pro Max</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-3xl font-bold text-emerald-600 mb-1">24</div>
                    <div class="text-sm font-medium text-gray-600">อุปกรณ์พอร์ต USB-C</div>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-3xl font-bold text-gray-400 mb-1">3</div>
                    <div class="text-sm font-medium text-gray-600">สินค้ายังไม่ระบุความเข้ากันได้</div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>