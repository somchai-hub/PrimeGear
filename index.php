<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrimeGear | อุปกรณ์เสริมไอทีที่ใช่สำหรับคุณ</title>
    <!-- เรียกใช้ Tailwind CSS ผ่าน CDN เพื่อความรวดเร็วในการตกแต่ง -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- เรียกใช้ Font Awesome สำหรับไอคอน -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-2xl font-bold text-blue-600">
                        <i class="fa-solid fa-bolt"></i> PrimeGear
                    </a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-900 font-medium hover:text-blue-600">หน้าแรก</a>
                    <a href="catalog.php" class="text-gray-500 hover:text-blue-600">สินค้าทั้งหมด</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section & Shop by Device (ระบบค้นหาหลัก) -->
    <div id="shop-by-device" class="bg-blue-600 text-white py-20">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">หาอุปกรณ์เสริมที่ตรงกับเครื่องของคุณ</h1>
            <p class="text-xl mb-8 text-blue-100">ไม่ต้องกลัวซื้อผิดรุ่น! เลือกรุ่นมือถือหรือแท็บเล็ตของคุณเพื่อดูสินค้าที่รองรับ</p>
            
            <!-- กล่องค้นหา (Search Box) -->
            <div class="bg-white p-6 rounded-lg shadow-lg flex flex-col md:flex-row gap-4 justify-center items-end">
                <div class="w-full md:w-1/3 text-left">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="brand">1. เลือกแบรนด์</label>
                    <select id="brand" class="w-full p-3 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:border-blue-500" onchange="updateModels()">
                        <option value="">-- กรุณาเลือกแบรนด์ --</option>
                        <option value="apple">Apple</option>
                        <option value="samsung">Samsung</option>
                        <option value="vivo">Vivo</option>
                    </select>
                </div>
                <div class="w-full md:w-1/3 text-left">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="model">2. เลือกรุ่น</label>
                    <select id="model" class="w-full p-3 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:border-blue-500" disabled>
                        <option value="">-- กรุณาเลือกแบรนด์ก่อน --</option>
                    </select>
                </div>
                <div class="w-full md:w-1/4">
                    <button class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-md transition duration-300" onclick="searchProducts()">
                        ค้นหาสินค้า <i class="fa-solid fa-magnifying-glass ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Catalog (จำลองหน้ารายการสินค้า) -->
    <div id="catalog" class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-10">สินค้าแนะนำ</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Product 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Phone Case" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-xs font-semibold text-blue-600 mb-1">เคสกันกระแทก</div>
                    <h3 class="text-xl font-bold mb-2">Armor Case Pro</h3>
                    <p class="text-gray-600 mb-4 text-sm">เคสใสกันกระแทกยอดนิยม รองรับชาร์จไร้สายแม่เหล็ก</p>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">฿ 890</span>
                        <!-- เปลี่ยนจาก Add to Cart เป็น เช็คสต็อกสาขา ตาม Requirement -->
                        <a href="detail.php?id=armor-case" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition duration-300">
                            ดูรายละเอียด <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1583863788434-e58a36330cf0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Charger" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-xs font-semibold text-blue-600 mb-1">หัวชาร์จเร็ว (Adapter)</div>
                    <h3 class="text-xl font-bold mb-2">GaN Ultra 65W</h3>
                    <p class="text-gray-600 mb-4 text-sm">หัวชาร์จเทคโนโลยี GaN ขนาดเล็ก จ่ายไฟสูงสุด 65W</p>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">฿ 1,290</span>
                        <a href="detail.php?id=gan-charger" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition duration-300">
                            ดูรายละเอียด <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                <img src="https://images.unsplash.com/photo-1598285521990-eb9741a6b0c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60" alt="Cable" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-xs font-semibold text-blue-600 mb-1">สายชาร์จ (Cable)</div>
                    <h3 class="text-xl font-bold mb-2">Tough Braided C to C</h3>
                    <p class="text-gray-600 mb-4 text-sm">สายถักไนลอนทนทานพิเศษ ความยาว 1.5 เมตร (100W)</p>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold text-gray-900">฿ 590</span>
                        <a href="detail.php?id=tough-cable" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition duration-300">
                            ดูรายละเอียด <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Store Section / Where to buy -->
    <div id="store" class="bg-gray-200 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">สนใจสินค้า? พบกันได้ที่หน้าร้าน</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">ทางเราไม่มีระบบสั่งซื้อออนไลน์ เพื่อให้คุณได้สัมผัสและทดลองสินค้าจริงก่อนตัดสินใจซื้อ สามารถเช็คสต็อกและเข้ามาเลือกชมได้ที่สาขาใกล้บ้านคุณ</p>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300">
                <i class="fa-solid fa-map-location-dot mr-2"></i> ค้นหาสาขา PrimeGear ใกล้คุณ
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center">
        <p>&copy; 2026 PrimeGear IT Accessories. All rights reserved.</p>
    </footer>

    <!-- JavaScript สำหรับระบบค้นหาตามอุปกรณ์ -->
    <script>
        // ข้อมูลจำลอง (Mock Data) สำหรับรุ่นมือถือ
        const deviceData = {
            apple: [
                { id: 'ip17pm', name: 'iPhone 17 Pro Max' },
                { id: 'ip17p', name: 'iPhone 17 Pro' },
                { id: 'ip17', name: 'iPhone 17' },
                { id: 'ip16pm', name: 'iPhone 16 Pro Max' },
                { id: 'ip16p', name: 'iPhone 16 Pro' },
                { id: 'ip16', name: 'iPhone 16' },
                { id: 'ip15pm', name: 'iPhone 15 Pro Max' },
                { id: 'ip15p', name: 'iPhone 15 Pro' },
                { id: 'ip15', name: 'iPhone 15' }
            ],
            samsung: [
                { id: 's24u', name: 'Galaxy S24 Ultra' },
                { id: 's23u', name: 'Galaxy S23 Ultra' },
                { id: 'zfold5', name: 'Galaxy Z Fold 5' }
            ],
            vivo: [
                { id: 'vx300p', name: 'X 300 Pro' },
                { id: 'vx200p', name: 'X 200 Pro' }
            ]
        };

        function updateModels() {
            const brandSelect = document.getElementById('brand');
            const modelSelect = document.getElementById('model');
            const selectedBrand = brandSelect.value;

            // เคลียร์ค่าเก่า
            modelSelect.innerHTML = '<option value="">-- เลือกรุ่น --</option>';

            if (selectedBrand && deviceData[selectedBrand]) {
                modelSelect.disabled = false;
                // เพิ่มตัวเลือกรุ่นใหม่ตามแบรนด์ที่เลือก
                deviceData[selectedBrand].forEach(function(model) {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.name;
                    modelSelect.appendChild(option);
                });
            } else {
                modelSelect.disabled = true;
                modelSelect.innerHTML = '<option value="">-- กรุณาเลือกแบรนด์ก่อน --</option>';
            }
        }

        function searchProducts() {
            const brand = document.getElementById('brand').value;
            const model = document.getElementById('model').value;
            
            if(!brand || !model) {
                alert("กรุณาเลือกแบรนด์และรุ่นก่อนค้นหาสินค้าครับ");
                return;
            }
            
            const modelName = document.querySelector(`#model option[value="${model}"]`).textContent;
            alert(`กำลังค้นหาสินค้าที่รองรับ: ${modelName}\n(ในระบบจริงจะนำคุณไปยังหน้ารายการสินค้า)`);
        }
    </script>
</body>
</html>