<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';

// Get counts for food items, expenses, and sales
$food_count = $conn->query("SELECT COUNT(*) FROM food_items")->fetch_row()[0];
$expense_count = $conn->query("SELECT SUM(amount) FROM expenses")->fetch_row()[0];
$sales_count = $conn->query("SELECT SUM(amount) FROM sales")->fetch_row()[0];

//profit and loss query
$food_count = $conn->query("SELECT COUNT(*) FROM food_items")->fetch_row()[0];
$expense_count = $conn->query("SELECT SUM(amount) FROM expenses")->fetch_row()[0];
$sales_count = $conn->query("SELECT SUM(amount) FROM sales")->fetch_row()[0];
$profit = $sales_count - $expense_count;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Yum Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive meta -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-orange-100 to-yellow-200 min-h-screen py-8 px-4">

    <div class="max-w-4xl mx-auto">
        <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-800 mb-8">
            🍔 Yum Rush
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Food Items Summary -->
            <div class="bg-white p-4 shadow-lg rounded-lg">
    <h3 class="text-lg text-orange-600 font-semibold">🍕 Food Items</h3>
    <p>Total Food Items: <?= $food_count ?></p>
    <div class="mt-2">
        <a href="add_food.php" class="text-blue-500 block">➕ Add New Food</a>
        <a href="view_food.php" class="text-green-600 block">📋 View All Food</a>
    </div>
</div>

            <!-- Expenses Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-orange-600 mb-2">💸 Expenses</h3>
                <p class="text-gray-700 mb-2">Total Expenses: <span class="font-bold"><?= number_format($expense_count, 2) ?></span></p>
                <a href="add_expense.php" class="text-sm text-blue-600 hover:underline">➕ Add Expense</a>
                <a href="view_expense.php" class="text-green-600 block">📋 View Expense</a>
            </div>

            <!-- Sales Summary -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-orange-600 mb-2">💰 Sales</h3>
                <p class="text-gray-700 mb-2">Total Sales: <span class="font-bold"><?= number_format($sales_count, 2) ?></span></p>
                <a href="add_sale.php" class="text-sm text-blue-600 hover:underline">➕ Add Sale</a>
                <a href="view_sale.php" class="text-green-600 block">📋 View Sale</a>
            </div>
            <!-- Profit/Loss Summary -->
             <div class="bg-white rounded-xl shadow-lg p-6 col-span-1 sm:col-span-2 lg:col-span-3">
                <h3 class="text-lg font-semibold text-orange-600 mb-2">📊 Profit / Loss</h3>
                <p class="text-gray-700 text-xl font-bold">
                <?= ($profit >= 0) 
                    ? "<span class='text-green-600'>Profit: ৳" . number_format($profit, 2) . "</span>" 
                    : "<span class='text-red-600'>Loss: ৳" . number_format(abs($profit), 2) . "</span>" ?>
                 </p>
            </div>


        </div>
    </div>
    <div class="text-right max-w-4xl mx-auto mb-4 mt-5">
    <a href="../logout.php" 
       class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
        🔓 Logout
    </a>
</div>

</body>
</html>
