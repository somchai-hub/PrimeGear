<?php
require 'process/client.php'; // เชื่อมต่อฐานข้อมูล

$product = null;
$error_message = "";

// 1. ตรวจสอบว่ามีคีย์ 'id' ส่งมาใน URL หรือไม่
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // บังคับให้เป็นตัวเลขเท่านั้น (ป้องกัน SQL Injection ได้ดีเยี่ยม)
    $id = (int)$_GET['id']; 
    
    // 2. ใช้คำสั่ง Query ธรรมดา เลี่ยงการใช้ get_result() ที่อาจทำให้หน้าขาว
    $sql = "SELECT * FROM products WHERE Product_ID = $id";
    $result = $conn->query($sql);
    
    // 3. ตรวจสอบว่าคิวรีสำเร็จและพบข้อมูลหรือไม่
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $error_message = "ขออภัย ไม่พบสินค้านี้ในระบบ หรือสินค้าอาจถูกลบไปแล้ว";
    }
} else {
    $error_message = "รหัสสินค้าไม่ถูกต้อง หรือไม่ได้เลือกสินค้า";
}
?>
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
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <?php if ($error_message): ?>
            <!-- กรณีไม่พบสินค้า หรือ Error -->
            <div class="bg-red-50 text-red-500 p-8 rounded-xl text-center border border-red-100">
                <i class="fa-solid fa-triangle-exclamation text-4xl mb-4"></i>
                <h2 class="text-xl font-semibold"><?php echo $error_message; ?></h2>
                <a href="catalog.php" class="inline-block mt-4 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">กลับไปหน้าสินค้าทั้งหมด</a>
            </div>
        <?php else: ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            
                <div class="md:w-1/2 p-6 bg-gray-100 flex flex-col items-center justify-center">
                    <?php $imagePath = !empty($product['Image']) ? $product['Image'] : 'https://via.placeholder.com/600x600?text=No+Image'; ?>
                    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['Name']); ?>" class="object-cover h-full w-full rounded-lg shadow-sm">
                </div>

                <div class="md:w-1/2 p-8 lg:p-12">
                    <div class="mb-2 flex items-center space-x-2">
                        <span class="text-sm font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wider">
                            <?php echo htmlspecialchars($product['Catagory']); ?>
                        </span>
                        <?php if (!empty($product['Brand'])): ?>
                            <span class="text-sm text-gray-500 border border-gray-200 px-3 py-1 rounded-full">
                            แบรนด์: <?php echo htmlspecialchars($product['Brand']); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                    <?php echo htmlspecialchars($product['Name']); ?>
                    </h1>
                    
                    <div class="text-3xl font-extrabold text-gray-900 mb-6">
                        ฿<?php echo number_format($product['Price'], 2); ?>
                    </div>
                    
                    <div class="prose prose-sm text-gray-600 mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">รายละเอียดสินค้า</h3>
                        <!-- ใช้ nl2br เพื่อให้ข้อความที่มีการขึ้นบรรทัดใหม่ในฐานข้อมูล แสดงผลขึ้นบรรทัดใหม่ตามจริงบนเว็บ -->
                        <p class="leading-relaxed"><?php echo nl2br(htmlspecialchars($product['Description'])); ?></p>
                    </div>
                    
                    <div class="flex space-x-4 mt-auto">
                        <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-xl transition-colors shadow-lg shadow-blue-200 flex justify-center items-center">
                            ย้อนกลับ
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>
</body>
</html>