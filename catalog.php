<?php
require 'process/client.php'; 
$sql = "SELECT * FROM products ORDER BY Product_ID DESC";
$result = $conn->query($sql);
?>
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
                    <a href="catalog.php" class="text-blue-600 font-medium">สินค้าทั้งหมด</a>
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
                <p class="text-gray-600 mb-4 sm:mb-0">แสดงผล <span class="font-bold text-gray-900"><?php echo $result->num_rows; ?></span> รายการ</p>
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
             <!-- Grid แสดงสินค้า -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php if ($result->num_rows > 0): ?>
                <!-- วนลูปแสดงสินค้าทีละชิ้น -->
                    <?php while($row = $result->fetch_assoc()): ?>
                    <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 flex flex-col">
                        
                        <!-- รูปภาพสินค้า -->
                        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">
                            <?php 
                            // เช็คว่ามีรูปหรือไม่ ถ้าไม่มีให้ใช้รูป Default
                            $imagePath = !empty($row['Image']) ? $row['Image'] : 'https://via.placeholder.com/300x300?text=No+Image'; 
                            ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($row['Name']); ?>" class="w-full h-48 object-cover object-center group-hover:opacity-75">
                        </div>

                        <!-- รายละเอียดสินค้า -->
                        <div class="p-4 flex flex-col flex-1">
                            <span class="text-xs font-semibold text-blue-500 mb-1 tracking-wide uppercase">
                                <?php echo htmlspecialchars($row['Catagory']); ?>
                            </span>
                            <h3 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1">
                                <?php echo htmlspecialchars($row['Name']); ?>
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-1">
                                <?php echo htmlspecialchars($row['Description']); ?>
                            </p>
                            
                            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                                <span class="text-lg font-bold text-gray-900">
                                    ฿<?php echo number_format($row['Price'], 2); ?>
                                </span>
                            </div>
                            <a href="detail.php?id=<?php echo $row['Product_ID']; ?>" class="w-full block text-center bg-blue-50 text-blue-600 border border-blue-200 font-semibold py-2 rounded-lg hover:bg-blue-600 hover:text-white transition-colors duration-300">
                                ดูรายละเอียด
                            </a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                <?php else: ?>
                <!-- กรณีไม่มีข้อมูลในตาราง -->
                <div class="col-span-full text-center py-12">
                    <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">ยังไม่มีสินค้าในระบบขณะนี้</p>
                </div>
                <?php endif; ?>
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
</body>
</html>