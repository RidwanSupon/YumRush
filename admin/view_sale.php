<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $conn->query("DELETE FROM sales WHERE id = $id");
    header("Location: view_sale.php");
    exit;
}

if (isset($_GET['clear_all'])) {
    $conn->query("DELETE FROM sales");
    header("Location: view_sale.php");
    exit;
}

$result = $conn->query("SELECT * FROM sales ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Sales - Yum Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-yellow-100 to-yellow-300 min-h-screen py-6 px-3 sm:px-6">

    <div class="max-w-5xl mx-auto bg-white shadow-xl rounded-2xl p-4 sm:p-8">
        <div class="flex flex-col sm:flex-row items-center justify-between mb-6 gap-4">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-indigo-600 text-center sm:text-left">📊 All Sales</h2>
            <div class="flex flex-row gap-3 w-full sm:w-auto">
                <a href="add_sale.php"
                   class="w-full sm:w-auto text-center bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                    ➕ Add Sale
                </a>
                <a href="?clear_all=1"
                   onclick="return confirm('Are you sure you want to delete ALL sales?')"
                   class="w-full sm:w-auto text-center bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition">
                    🧹 Clear All
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-xs sm:text-sm md:text-base table-auto bg-white border border-gray-200 rounded-lg">
                <thead class="bg-indigo-100 text-indigo-700 font-semibold">
                    <tr>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-left">Note</th>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-left">Amount (৳)</th>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-left">Date</th>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 sm:px-4 py-3 break-words"><?= htmlspecialchars($row['note']) ?></td>
                                <td class="px-3 sm:px-4 py-3 text-green-600 font-medium">৳<?= number_format($row['amount'], 2) ?></td>
                                <td class="px-3 sm:px-4 py-3"><?= htmlspecialchars($row['date']) ?></td>
                                <td class="px-3 sm:px-4 py-3 text-center">
                                    <a href="?delete_id=<?= $row['id'] ?>"
                                       onclick="return confirm('Are you sure you want to delete this sale?')"
                                       class="text-red-600 hover:text-red-800 font-semibold transition text-sm">
                                        🗑️ Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">No sales records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-center">
            <a href="dashboard.php" class="text-indigo-600 hover:underline text-sm font-medium">🔙 Back to Dashboard</a>
        </div>
    </div>

</body>
</html>
