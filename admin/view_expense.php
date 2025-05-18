<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $conn->query("DELETE FROM expenses WHERE id = $id");
    header("Location: view_expense.php");
    exit;
}

if (isset($_GET['clear_all'])) {
    $conn->query("DELETE FROM expenses");
    header("Location: view_expense.php");
    exit;
}

$result = $conn->query("SELECT * FROM expenses ORDER BY date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>View Expenses - Yum Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-orange-100 to-yellow-200 min-h-screen py-6 px-3 sm:px-6">

    <div class="max-w-5xl mx-auto bg-white p-4 sm:p-6 md:p-8 rounded-xl shadow-lg">
        <h2 class="text-lg sm:text-2xl font-extrabold text-center text-gray-800 mb-6">📋 All Expenses</h2>

        <!-- Top Buttons -->
        <div class="flex flex-row sm:justify-between items-center gap-3 mb-4">
            <a href="add_expense.php"
               class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-[10px] sm:text-sm text-center shadow-md transition">
                ➕ Add Expense
            </a>
            <a href="?clear_all=1"
               onclick="return confirm('Are you sure you want to delete all expense records?')"
               class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-[10px] sm:text-sm text-center shadow-md transition">
                🧹 Clear All
            </a>
        </div>

        <!-- Table WITHOUT horizontal scroll -->
        <table class="w-full border border-gray-200 text-[10px] sm:text-sm" style="table-layout: fixed;">
    <thead class="bg-orange-200 text-gray-800 font-semibold">
        <tr>
            <th class="px-2 py-1 text-left break-words w-1/4">Reason</th>
            <th class="px-2 py-1 text-right w-1/4">Amount</th>
            <th class="px-2 py-1 text-center w-1/4">Date</th>
            <th class="px-2 py-1 text-center w-1/4">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr class="hover:bg-orange-50 transition duration-150">
                <td class="px-2 py-1 break-words"><?= htmlspecialchars($row['reason']) ?></td>
                <td class="px-2 py-1 text-right text-green-600 font-semibold">৳<?= number_format($row['amount'], 2) ?></td>
                <td class="px-2 py-1 text-center"><?= htmlspecialchars($row['date']) ?></td>
                <td class="px-2 py-1 text-center">
                    <a href="?delete_id=<?= $row['id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this expense?')"
                       class="text-red-600 px-2 py-0.5 rounded text-[10px] transition">
                        🗑 Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center px-2 py-6 text-gray-500 text-sm">No expense records found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>


        <!-- Back Button -->
        <div class="mt-6 text-center">
            <a href="dashboard.php" class="text-indigo-600 hover:underline text-sm font-medium">🔙 Back to Dashboard</a>
        </div>
    </div>

</body>
</html>
