<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../includes/db.php';
require_once '../includes/auth.php';

// Fetch Monthly Sales & Expenses
$monthly_summary = $conn->query("
    SELECT 
        DATE_FORMAT(s.date, '%M %Y') AS month,
        SUM(s.amount) AS total_sales,
        (
            SELECT SUM(e.amount) 
            FROM expenses e 
            WHERE YEAR(e.date) = YEAR(s.date) AND MONTH(e.date) = MONTH(s.date)
        ) AS total_expenses
    FROM sales s
    GROUP BY YEAR(s.date), MONTH(s.date)
    ORDER BY YEAR(s.date) DESC, MONTH(s.date) DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monthly Summary - Yum Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen p-1">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-center text-orange-600 mb-6">📊 Monthly Summary</h1>

        <div class="bg-white p-2 rounded-lg shadow border border-orange-200">
            <table class="w-full table-fixed text-xs sm:text-sm md:text-base text-gray-800 border border-orange-300">
    <thead class="bg-orange-100 text-orange-800 font-semibold">
        <tr>
            <th class="px-2 py-2">📅 Month</th>
            <th class="px-2 py-2 text-green-700">Sales</th>
            <th class="px-2 py-2 text-red-600">Expenses</th>
            <th class="px-2 py-2 text-blue-600">Profit</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($monthly_summary->num_rows > 0): ?>
            <?php while ($row = $monthly_summary->fetch_assoc()): ?>
                <?php
                    $sales = $row['total_sales'] ?? 0;
                    $expenses = $row['total_expenses'] ?? 0;
                    $profit = $sales - $expenses;
                ?>
                <tr class="border-b hover:bg-orange-50">
                    <td class="px-2 py-2 text-center align-middle"><?= htmlspecialchars($row['month']) ?></td>
                    <td class="px-2 py-2 text-green-700 font-semibold text-center align-middle">৳<?= number_format($sales, 0) ?></td>
                    <td class="px-2 py-2 text-red-600 font-semibold text-center align-middle">৳<?= number_format($expenses, 0) ?></td>
                    <td class="px-2 py-2 text-blue-600 font-semibold text-center align-middle">৳<?= number_format($profit, 0) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="px-2 py-4 text-center text-gray-500">No data available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

        </div>
    </div>
      <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="dashboard.php" class="text-indigo-600 hover:underline text-sm font-medium">🔙 Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
