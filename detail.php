<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดสินค้า | PrimeGear</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Prompt', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

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
                </div>
            </div>
        </div>
    </nav>

    <div id="product-container" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 hidden">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            
            <div class="md:w-1/2 p-6 bg-gray-100 flex flex-col items-center justify-center">
                <div class="w-full h-80 md:h-96 mb-4 rounded-lg overflow-hidden bg-white shadow-sm flex items-center justify-center">
                    <img id="pd-image" src="" alt="Product Image" class="object-cover h-full w-full">
                </div>
            </div>

            <div class="md:w-1/2 p-8 lg:p-12">
                <div id="pd-category" class="text-sm font-semibold text-blue-600 mb-2 uppercase tracking-wide">หมวดหมู่</div>
                <h1 id="pd-title" class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">ชื่อสินค้า</h1>
                <p id="pd-price" class="text-2xl font-bold text-gray-900 mb-6">ราคา</p>
                
                <p id="pd-description" class="text-gray-600 mb-8 leading-relaxed">รายละเอียดสินค้า...</p>

                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-8">
                    <h4 class="text-green-800 font-bold flex items-center mb-2">
                        <i class="fa-solid fa-circle-check mr-2"></i> อุปกรณ์ที่รองรับ
                    </h4>
                    <p id="pd-compatibility" class="text-sm text-green-700 leading-relaxed"></p>
                </div>

                <button onclick="alert('ระบบจำลอง: เช็คสาขาที่วางจำหน่ายสินค้านี้')" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold py-4 rounded-lg shadow-md transition duration-300">
                    ย้อนกลับ
                </button>
            </div>
        </div>
    </div>

    <div id="error-container" class="max-w-7xl mx-auto px-4 py-20 text-center hidden">
        <h2 class="text-3xl font-bold text-red-600 mb-4">ไม่พบข้อมูลสินค้า</h2>
        <p class="text-gray-600 mb-8">สินค้าที่คุณค้นหาอาจถูกลบออกไปแล้ว หรือลิงก์ไม่ถูกต้อง</p>
        <a href="index.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-bold">กลับไปหน้าแรก</a>
    </div>

    <script>
        // 1. ฐานข้อมูลจำลอง (Mock Database)
        const productsDatabase = {
            "armor-case": {
                title: "Armor Case Pro",
                category: "เคสกันกระแทก",
                price: "฿ 890",
                image: "https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
                description: "เคสใสกันกระแทกยอดนิยม รองรับชาร์จไร้สายแม่เหล็ก ขอบยาง TPU ยืดหยุ่นสูง ป้องกันการตกกระแทกได้ถึง 3 เมตร",
                compatibility: "<strong>Apple:</strong> iPhone 15, 15 Pro, 15 Pro Max<br><strong>Samsung:</strong> ไม่รองรับ"
            },
            "gan-charger": {
                title: "GaN Ultra 65W",
                category: "หัวชาร์จเร็ว (Adapter)",
                price: "฿ 1,290",
                image: "https://images.unsplash.com/photo-1583863788434-e58a36330cf0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
                description: "หัวชาร์จเทคโนโลยี GaN ขนาดเล็กพกพาง่าย จ่ายไฟสูงสุด 65W ชาร์จ MacBook หรือสมาร์ตโฟนได้อย่างรวดเร็ว ไม่ร้อน",
                compatibility: "รองรับสมาร์ตโฟน, แท็บเล็ต และแล็ปท็อปทุกรุ่น ที่รองรับระบบชาร์จผ่านพอร์ต Type-C"
            },
            "tough-cable": {
                title: "Tough Braided C to C (100W)",
                category: "สายชาร์จ (Cable)",
                price: "฿ 590",
                image: "https://images.unsplash.com/photo-1598285521990-eb9741a6b0c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80",
                description: "สายชาร์จถักไนลอนความทนทานสูง รองรับการชาร์จเร็วสูงสุด 100W หัวพอร์ตทำจากอลูมิเนียมอัลลอยด์ ป้องกันการหักงอ",
                compatibility: "<strong>Apple:</strong> iPhone 15 Series, iPad Pro, MacBook<br><strong>Samsung:</strong> Galaxy S24/S23 Series, Z Fold 5"
            }
        };

        // 2. ดึงค่า ID จาก URL (เช่น product-detail.html?id=armor-case)
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('id');

        // 3. ตรวจสอบและแสดงข้อมูล
        if (productId && productsDatabase[productId]) {
            // พบสินค้า -> นำข้อมูลไปใส่ใน HTML
            const product = productsDatabase[productId];
            
            document.title = product.title + " | PrimeGear";
            document.getElementById('pd-image').src = product.image;
            document.getElementById('pd-category').innerHTML = product.category;
            document.getElementById('pd-title').innerHTML = product.title;
            document.getElementById('pd-price').innerHTML = product.price;
            document.getElementById('pd-description').innerHTML = product.description;
            document.getElementById('pd-compatibility').innerHTML = product.compatibility;

            // แสดงคอนเทนเนอร์สินค้า
            document.getElementById('product-container').classList.remove('hidden');
        } else {
            // ไม่พบสินค้า -> แสดงหน้า Error
            document.getElementById('error-container').classList.remove('hidden');
        }
    </script>
</body>
</html>