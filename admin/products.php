<?php
session_start();
require '../process/client.php'; 

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';

// ---------------------------------------------------------
// 1. จัดการฟอร์ม (ทั้ง เพิ่มสินค้า และ แก้ไขสินค้า)
// ---------------------------------------------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action_type'])) {
    $code = $_POST['product_code'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $desc = $_POST['description'];
    $image = $_POST['image'];
    $brand = $_POST['brand'];
    
    if ($_POST['action_type'] == 'add') {
        // --- เพิ่มสินค้าใหม่ (INSERT) ---
        $stmt = $conn->prepare("INSERT INTO products (Product_ID, Name, Catagory, Price, Description, Image, Brand) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdsss", $code, $name, $category, $price, $desc, $image, $brand);
        $stmt->execute();
        $stmt->close();
        
    } elseif ($_POST['action_type'] == 'edit') {
        // --- แก้ไขสินค้า (UPDATE) ---
        $id = $_POST['product_id'];
        $stmt = $conn->prepare("UPDATE products SET product_code=?, Name=?, Catagory=?, Price=?, Description=?, Image=?, Brand=? WHERE Product_ID=?");
        $stmt->bind_param("sssdsssi", $code, $name, $category, $price, $desc, $image, $brand, $id);
        $stmt->execute();
        $stmt->close();
    }
    
    // รีเฟรชหน้าเพื่ออัปเดตข้อมูล
    header("Location: products.php");
    exit();
}

// ---------------------------------------------------------
// 2. จัดการการลบสินค้า (DELETE)
// ---------------------------------------------------------
if (isset($_GET['delete_id'])) {
    $del_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE Product_ID = ?");
    $stmt->bind_param("i", $del_id);
    $stmt->execute();
    $stmt->close();
    header("Location: products.php");
    exit();
}

// ---------------------------------------------------------
// 3. ดึงข้อมูลสินค้าทั้งหมดมาแสดง
// ---------------------------------------------------------
$result = $conn->query("SELECT * FROM products ORDER BY Product_ID DESC");
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการสินค้า | PrimeGear Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Prompt', sans-serif; }
        .modal-active { display: flex !important; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden text-gray-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col flex-shrink-0">
        <div class="h-16 flex items-center px-6 bg-gray-950 border-b border-gray-800">
            <a href="dashboard.php" class="text-xl font-bold text-blue-400 flex items-center">
                <i class="fa-solid fa-bolt mr-2 text-yellow-400"></i> PrimeGear
            </a>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="dashboard.php" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
                <i class="fa-solid fa-chart-pie w-5 mr-3"></i> แผงควบคุม
            </a>
            <a href="products.php" class="flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg">
                <i class="fa-solid fa-box w-5 mr-3"></i> จัดการสินค้า
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8 z-10">
            <h2 class="text-xl font-semibold text-gray-800">จัดการสินค้า</h2>
            <div class="flex items-center space-x-4">
                <span class="mr-3 text-sm font-medium"><?php echo htmlspecialchars($admin_name); ?></span>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <div class="relative w-full sm:w-96">
                    <input type="text" placeholder="ค้นหาสินค้า..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                </div>
                <!-- เปลี่ยนไปเรียก openAddModal() แทน -->
                <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors shadow-sm flex items-center w-full sm:w-auto justify-center">
                    <i class="fa-solid fa-plus mr-2"></i> เพิ่มสินค้าใหม่
                </button>
            </div>

            <!-- ตารางสินค้า -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-gray-500 uppercase text-xs border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4">รหัส / ชื่อสินค้า</th>
                                <th class="px-6 py-4">หมวดหมู่</th>
                                <th class="px-6 py-4">ราคา (฿)</th>
                                <th class="px-6 py-4 text-center">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php if ($result->num_rows > 0): ?>
                                <?php while($row = $result->fetch_assoc()): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-3">
                                        <p class="font-bold text-gray-900"><?php echo htmlspecialchars($row['Name']); ?></p>
                                        <p class="text-xs text-gray-500">Code: <?php echo htmlspecialchars($row['product_code']); ?></p>
                                    </td>
                                    <td class="px-6 py-3"><?php echo htmlspecialchars($row['Catagory']); ?></td>
                                    <td class="px-6 py-3 font-medium text-gray-900"><?php echo number_format($row['Price'], 2); ?></td>
                                    <td class="px-6 py-3 text-center whitespace-nowrap">
                                        <!-- ปุ่มแก้ไข (แนบข้อมูลทั้งหมดไปกับ JavaScript Function) -->
                                        <button onclick="openEditModal(
                                            <?php echo $row['Product_ID']; ?>,
                                            '<?php echo htmlspecialchars($row['product_code'], ENT_QUOTES); ?>',
                                            '<?php echo htmlspecialchars($row['Name'], ENT_QUOTES); ?>',
                                            '<?php echo htmlspecialchars($row['Catagory'], ENT_QUOTES); ?>',
                                            <?php echo $row['Price']; ?>,
                                            '<?php echo htmlspecialchars($row['Description'], ENT_QUOTES); ?>',
                                            '<?php echo htmlspecialchars($row['Image'], ENT_QUOTES); ?>'
                                        )" class="text-blue-500 hover:text-blue-700 mx-1 p-2 rounded hover:bg-blue-50 transition" title="แก้ไข">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        
                                        <!-- ปุ่มลบ -->
                                        <button onclick="confirmDelete(<?php echo $row['Product_ID']; ?>, '<?php echo addslashes($row['Name']); ?>')" class="text-red-500 hover:text-red-700 mx-1 p-2 rounded hover:bg-red-50 transition" title="ลบ">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">ยังไม่มีข้อมูลสินค้าในระบบ</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal ฟอร์ม (ใช้ร่วมกันทั้ง เพิ่ม และ แก้ไข) -->
    <div id="productModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl overflow-hidden flex flex-col max-h-[90vh]">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-bold text-gray-900" id="modalTitle">เพิ่มสินค้าใหม่</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="p-6 overflow-y-auto flex-1">
                <form id="productForm" action="products.php" method="POST" class="space-y-4">
                    
                    <!-- ฟิลด์ซ่อนสำหรับบอก PHP ว่าให้ เพิ่ม(add) หรือ แก้ไข(edit) -->
                    <input type="hidden" name="action_type" id="action_type" value="add">
                    <!-- ฟิลด์ซ่อนสำหรับเก็บ ID สินค้าตอนแก้ไข -->
                    <input type="hidden" name="product_id" id="product_id" value="">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">รหัสสินค้า</label>
                            <input type="text" name="product_code" id="input_code" required class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ชื่อสินค้า *</label>
                            <input type="text" name="name" id="input_name" required class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">แบรน์ด</label>
                            <input type="text" name="brand" id="input_brand" required class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">หมวดหมู่</label>
                            <select name="category" id="input_category" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="เคส">เคส</option>
                                <option value="สายชาร์จ">สายชาร์จ</option>
                                <option value="หัวชาร์จ">หัวชาร์จ</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ราคา (บาท) *</label>
                            <input type="number" name="price" id="input_price" step="0.01" required class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">รายละเอียดสินค้า</label>
                        <textarea name="description" id="input_desc" rows="3" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                     <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">รูปภาพ</label>
                        <input type="url" name="image" id="input_image" class="w-full border border-gray-300 rounded-lg p-2 text-sm focus:ring-blue-500 focus:border-blue-500"></input>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition">ยกเลิก</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition">บันทึกข้อมูล</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('productModal');

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('modal-active');
        }

        // 1. ฟังก์ชันเปิด Modal เพื่อ "เพิ่มข้อมูลใหม่"
        function openAddModal() {
            document.getElementById('modalTitle').innerText = 'เพิ่มสินค้าใหม่';
            document.getElementById('action_type').value = 'add';
            document.getElementById('product_id').value = '';
            document.getElementById('productForm').reset(); // เคลียร์ค่าในฟอร์มทั้งหมด
            
            modal.classList.remove('hidden');
            modal.classList.add('modal-active');
        }

        // 2. ฟังก์ชันเปิด Modal เพื่อ "แก้ไขข้อมูลเดิม"
        function openEditModal(id, code, name, category, price, desc, image, brand) {
            document.getElementById('modalTitle').innerText = 'แก้ไขสินค้า: ' + name;
            
            // เซ็ตค่าให้ Input ซ่อน เพื่อบอก PHP ว่านี่คือการแก้ไข
            document.getElementById('action_type').value = 'edit';
            document.getElementById('product_id').value = id;
            
            // ดึงข้อมูลเดิมมาใส่ในช่องกรอก
            document.getElementById('input_code').value = code;
            document.getElementById('input_name').value = name;
            document.getElementById('input_category').value = category;
            document.getElementById('input_price').value = price;
            document.getElementById('input_desc').value = desc;
            document.getElementById('input_image').value = image;
            document.getElementById('input_brand').value = brand;
            
            modal.classList.remove('hidden');
            modal.classList.add('modal-active');
        }

        // 3. ยืนยันการลบ
        function confirmDelete(id, name) {
            if (confirm(`คุณแน่ใจหรือไม่ว่าต้องการลบสินค้า: ${name} ?\n(ข้อมูลจะไม่สามารถกู้คืนได้)`)) {
                window.location.href = `products.php?delete_id=${id}`;
            }
        }
    </script>
</body>
</html>