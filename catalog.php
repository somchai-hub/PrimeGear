<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แคตตาล็อกสินค้า | PrimeGear</title>
    <!-- เรียกใช้ Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- เรียกใช้ Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Prompt', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="index.html" class="text-2xl font-bold text-blue-600">
                        <i class="fa-solid fa-bolt"></i> PrimeGear
                    </a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="index.php" class="text-gray-500 hover:text-blue-600">หน้าแรก</a>
                    <a href="catalog.php" class="text-blue-600 font-medium">แคตตาล็อกสินค้า</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Breadcrumbs & Page Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <nav class="text-sm text-gray-500 mb-2">
                <a href="index.php" class="hover:text-blue-600">หน้าแรก</a>
                <span class="mx-2"><i class="fa-solid fa-chevron-right text-xs"></i></span>
                <span class="text-gray-900 font-medium">แคตตาล็อกสินค้าทั้งหมด</span>
            </nav>
            <h1 class="text-3xl font-bold text-gray-900">สินค้าทั้งหมด (All Products)</h1>
        </div>
    </div>

    <!-- Main Content: Sidebar + Product Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col lg:flex-row gap-8">
        
        <!-- Sidebar: ตัวกรองสินค้า (Filters) -->
        <aside class="w-full lg:w-1/4 bg-white p-6 rounded-xl shadow-sm border border-gray-100 h-fit">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-bold flex items-center"><i class="fa-solid fa-filter mr-2"></i> ตัวกรอง</h2>
                <button class="text-sm text-blue-600 hover:underline">ล้างทั้งหมด</button>
            </div>
            
            <hr class="mb-4 border-gray-200">

            <!-- Filter: หมวดหมู่ -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-gray-900">หมวดหมู่สินค้า</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <label class="flex items-center cursor-pointer hover:text-blue-600">
                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2 w-4 h-4"> เคสกันกระแทก
                    </label>
                    <label class="flex items-center cursor-pointer hover:text-blue-600">
                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2 w-4 h-4"> สายชาร์จ (Cable)
                    </label>
                    <label class="flex items-center cursor-pointer hover:text-blue-600">
                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2 w-4 h-4"> หัวชาร์จ (Adapter)
                    </label>
                    <label class="flex items-center cursor-pointer hover:text-blue-600">
                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2 w-4 h-4"> พาวเวอร์แบงค์
                    </label>
                </div>
            </div>

            <!-- Filter: แบรนด์ที่รองรับ -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-gray-900">รองรับอุปกรณ์แบรนด์</h3>
                <div class="space-y-2 text-sm text-gray-600">
                    <label class="flex items-center cursor-pointer hover:text-blue-600">
                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2 w-4 h-4"> Apple
                    </label>
                    <label class="flex items-center cursor-pointer hover:text-blue-600">
                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2 w-4 h-4"> Samsung
                    </label>
                    <label class="flex items-center cursor-pointer hover:text-blue-600">
                        <input type="checkbox" class="rounded text-blue-600 focus:ring-blue-500 mr-2 w-4 h-4"> Universal (ใช้ได้ทั่วไป)
                    </label>
                </div>
            </div>

            <!-- Filter: ช่วงราคา -->
            <div>
                <h3 class="font-semibold mb-3 text-gray-900">ช่วงราคา (บาท)</h3>
                <div class="flex items-center space-x-2">
                    <input type="number" placeholder="ต่ำสุด" class="w-full border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:border-blue-500">
                    <span class="text-gray-400">-</span>
                    <input type="number" placeholder="สูงสุด" class="w-full border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <button class="w-full mt-3 bg-gray-900 text-white py-2 rounded-md text-sm hover:bg-gray-800 transition">ตกลง</button>
            </div>
        </aside>

        <!-- Main Product Grid -->
        <main class="w-full lg:w-3/4">
            
            <!-- Sorting & Results count -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                <p class="text-gray-600 mb-4 sm:mb-0">แสดงผล <span class="font-bold text-gray-900" id="product-count">0</span> รายการ</p>
                <div class="flex items-center space-x-2">
                    <label for="sort" class="text-sm text-gray-600">เรียงตาม:</label>
                    <select id="sort" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:border-blue-500">
                        <option>สินค้าใหม่ล่าสุด</option>
                        <option>สินค้ายอดนิยม</option>
                        <option>ราคา: ต่ำ - สูง</option>
                        <option>ราคา: สูง - ต่ำ</option>
                    </select>
                </div>
            </div>

            <!-- Grid Container สำหรับใส่สินค้า (ดึงข้อมูลด้วย JS) -->
            <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- สินค้าจะถูกสร้างขึ้นที่นี่ด้วย JavaScript -->
            </div>

            <!-- Pagination -->
            <div class="mt-10 flex justify-center">
                <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    <a href="#" aria-current="page" class="z-10 bg-blue-50 border-blue-500 text-blue-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 1 </a>
                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 2 </a>
                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"> 3 </a>
                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </nav>
            </div>
        </main>

    </div>

    <!-- Script แสดงข้อมูลสินค้า -->
    <script>
        // ข้อมูลจำลองของสินค้าทั้งหมด
        const products = [
            { id: "armor-case", name: "Armor Case Pro", category: "เคสกันกระแทก", price: 890, image: "https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
            { id: "gan-charger", name: "GaN Ultra 65W", category: "หัวชาร์จ", price: 1290, image: "https://images.unsplash.com/photo-1583863788434-e58a36330cf0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
            { id: "tough-cable", name: "Tough Braided C to C", category: "สายชาร์จ", price: 590, image: "https://images.unsplash.com/photo-1598285521990-eb9741a6b0c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
            { id: "powerbank-10k", name: "Magnetic PowerBank 10000mAh", category: "พาวเวอร์แบงค์", price: 1590, image: "https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
            { id: "air-buds", name: "True Wireless AirBuds Pro", category: "หูฟัง", price: 1990, image: "https://images.unsplash.com/photo-1590658268037-6bf12165a8df?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" },
            { id: "screen-guard", name: "Privacy Glass Protector", category: "ฟิล์มกันรอย", price: 350, image: "https://images.unsplash.com/photo-1541805562137-b3e34b9d520d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" }
        ];

        // อัปเดตจำนวนรายการสินค้า
        document.getElementById('product-count').innerText = products.length;

        // ฟังก์ชันสร้าง Card สินค้าและนำไปใส่ใน Grid
        const grid = document.getElementById('product-grid');
        
        products.forEach(product => {
            // สร้าง HTML สำหรับสินค้าแต่ละชิ้น
            const cardHTML = `
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col">
                    <div class="h-48 overflow-hidden bg-gray-100 flex items-center justify-center">
                        <img src="${product.image}" alt="${product.name}" class="object-cover h-full w-full hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <span class="text-xs font-semibold text-blue-600 mb-1 uppercase tracking-wider">${product.category}</span>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">${product.name}</h3>
                        <p class="text-xl font-bold text-gray-900 mt-auto mb-4">฿ ${product.price.toLocaleString()}</p>
                        
                        <!-- ลิงก์ไปยังหน้า Product Detail พร้อมแนบ ID -->
                        <a href="product-detail.html?id=${product.id}" class="w-full block text-center bg-blue-50 text-blue-600 border border-blue-200 font-semibold py-2 rounded-lg hover:bg-blue-600 hover:text-white transition-colors duration-300">
                            ดูรายละเอียด
                        </a>
                    </div>
                </div>
            `;
            // เพิ่มเข้าไปใน Grid
            grid.innerHTML += cardHTML;
        });
    </script>
</body>
</html>