<?php
session_start();
require '../includes/connect-db.php';
$message = '';
$message_status = '';

// 1. จัดการการเพิ่มข้อมูล (เมื่อฟอร์มถูก Submit)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_mapping') {
    //echo "<pre style='background:#fff; padding:20px; z-index:999; position:relative;'>"; print_r($_POST); echo "</pre>"; exit;
    $product_id = $_POST['product_id'] ?? '';
    $device_ids = $_POST['device_ids'] ?? []; // รับมาเป็น Array

    if ($product_id !== '' && is_array($device_ids) && count($device_ids) > 0) {
        $success = 0;
        $duplicate = 0;
        
        // ใช้ INSERT IGNORE เพื่อข้ามคู่ที่เคยจับคู่ไว้แล้ว
        $stmt = $conn->prepare("INSERT IGNORE INTO product_device_mapping (product_id, device_id) VALUES (?, ?)");
        
        foreach ($device_ids as $device_id) {
            $stmt->bind_param("ii", $product_id, $device_id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $success++;
            } else {
                $duplicate++;
            }
        }
        $stmt->close();
        
        $message = "บันทึกการจับคู่สำเร็จ $success รายการ " . ($duplicate > 0 ? "(ข้อมูลซ้ำข้ามไป $duplicate รายการ)" : "");
        $message_status = 'success';
    } else {
        $message = "กรุณาเลือกสินค้าและอุปกรณ์อย่างน้อย 1 รายการ";
        $message_status = 'error';
    }
}

// 2. จัดการการลบข้อมูล
if (isset($_GET['del_p']) && isset($_GET['del_d'])) {
    $del_p = (int)$_GET['del_p'];
    $del_d = (int)$_GET['del_d'];
    $conn->query("DELETE FROM product_device_mapping WHERE product_id = $del_p AND device_id = $del_d");
    header("Location: compatibility.php?msg=deleted");
    exit();
}

// ดึงข้อมูล Master Data สำหรับแสดงในฟอร์ม
$products = $conn->query("SELECT Product_ID, Name FROM Products ORDER BY Name ASC");
$devices_res = $conn->query("SELECT Device_ID, Brand, Model_Name FROM Devices ORDER BY Brand ASC, Model_Name ASC");

$devices_by_brand = [];
if ($devices_res) {
    while ($row = $devices_res->fetch_assoc()) {
        $devices_by_brand[$row['Brand']][] = $row;
    }
}

// ดึงข้อมูลการจับคู่ปัจจุบันสำหรับแสดงในตาราง
$mapping_sql = "
    SELECT m.product_id, m.device_id, p.Name AS Name, d.Model_Name, d.Brand 
    FROM product_device_mapping m
    JOIN Products p ON m.product_id = p.Product_ID
    JOIN Devices d ON m.device_id = d.Device_ID
    ORDER BY p.Name ASC, d.brand ASC, Model_Name ASC
";
$mappings = $conn->query($mapping_sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าความเข้ากันได้ | PrimeGear Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Prompt', sans-serif; }
        .modal-active { display: flex !important; }
    </style>
    <link rel="icon" href="../favicon.png">
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
            <a href="devices.php" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
                <i class="fa-solid fa-chart-pie w-5 mr-3"></i> จัดการอุปกรณ์
            </a>
            <a href="products.php" class="flex items-center px-4 py-3 text-gray-400 hover:bg-gray-800 hover:text-white rounded-lg transition-colors">
                <i class="fa-solid fa-box w-5 mr-3"></i> จัดการสินค้า
            </a>
            <a href="compatibility.php" class="flex items-center px-4 py-3 bg-blue-600 text-white rounded-lg">
                <i class="fa-solid fa-box w-5 mr-3"></i> ตั้งค่าความเข้ากันได้
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col lg:flex-row gap-8">
        
        <!-- ฝั่งซ้าย: ฟอร์มเพิ่มข้อมูล -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">จับคู่สินค้ากับอุปกรณ์</h2>
                
                <?php if ($message): ?>
                    <div class="mb-4 p-3 rounded-lg text-sm <?php echo $message_status === 'success' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
                    <div class="mb-4 p-3 rounded-lg text-sm bg-blue-100 text-blue-700 border border-blue-200">
                        ลบการเชื่อมโยงเรียบร้อยแล้ว
                    </div>
                <?php endif; ?>

                <form action="compatibility.php" method="POST">
                    <input type="hidden" name="action" value="add_mapping">
                    
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">1. เลือกสินค้า</label>
                        <select name="product_id" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- ระบุสินค้า --</option>
                            <?php while($p = $products->fetch_assoc()): ?>
                                <option value="<?php echo $p['Product_ID']; ?>"><?php echo htmlspecialchars($p['Name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">2. เลือกอุปกรณ์ที่รองรับ (เลือกได้หลายข้อ)</label>
                        <div class="max-h-80 overflow-y-auto border border-gray-200 rounded-lg p-3 bg-gray-50">
                            <?php foreach ($devices_by_brand as $brand => $devices): ?>
                                <div class="mb-3 last:mb-0">
                                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 border-b border-gray-200 pb-1"><?php echo htmlspecialchars($brand); ?></div>
                                    <div class="space-y-2">
                                        <?php foreach ($devices as $d): ?>
                                            <label class="flex items-center space-x-3 cursor-pointer group">
                                                <input type="checkbox" name="device_ids[]" value="<?php echo $d['Device_ID']; ?>" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                                <span class="text-sm text-gray-700 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars($d['Model_Name']); ?></span>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition-colors shadow-sm">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> บันทึกการจับคู่
                    </button>
                </form>
            </div>
        </div>

        <!-- ฝั่งขวา: ตารางแสดงข้อมูลปัจจุบัน -->
        <div class="lg:w-2/3">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-gray-900"><i class="fa-solid fa-table-list mr-2"></i> ข้อมูลการจับคู่ทั้งหมด</h2>
                    <span class="text-sm text-gray-500">รวม <?php echo $mappings ? $mappings->num_rows : 0; ?> รายการ</span>
                </div>
                
                <div class="overflow-x-auto max-h-[600px] overflow-y-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider bg-gray-50">สินค้า</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider bg-gray-50">แบรนด์</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider bg-gray-50">รุ่นอุปกรณ์ที่รองรับ</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider bg-gray-50">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if ($mappings && $mappings->num_rows > 0): ?>
                                <?php while($row = $mappings->fetch_assoc()): ?>
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">
                                            <?php echo htmlspecialchars($row['Name']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <span class="px-2 py-1 bg-gray-100 rounded-md text-xs"><?php echo htmlspecialchars($row['Brand']); ?></span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 whitespace-nowrap">
                                            <?php echo htmlspecialchars($row['Model_Name']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="compatibility.php?del_p=<?php echo $row['product_id']; ?>&del_d=<?php echo $row['device_id']; ?>" 
                                               onclick="return confirm('ต้องการยกเลิกการจับคู่สินค้านี้กับ <?php echo htmlspecialchars($row['Model_Name']); ?> ใช่หรือไม่?')"
                                               class="text-red-500 hover:text-red-700 bg-red-50 p-2 rounded-lg transition-colors" title="ลบการเชื่อมต่อ">
                                                <i class="fa-solid fa-link-slash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                        <i class="fa-solid fa-inbox text-3xl mb-2 text-gray-300"></i><br>
                                        ยังไม่มีข้อมูลการจับคู่อุปกรณ์
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>