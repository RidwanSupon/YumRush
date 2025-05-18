<?php
require_once '../includes/auth.php';
require_once '../includes/db.php';


if (isset($_POST['add_expense'])) {
    $reason = $_POST['reason'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO expenses (reason, amount, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $reason, $amount, $date);
    if ($stmt->execute()) {
        $success = "✅ Expense added successfully!";
    } else {
        $error = "❌ Failed to add expense.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Expense - Yum Rush Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-yellow-100 to-orange-200 min-h-screen flex items-center justify-center px-4 py-8">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl px-6 py-8 sm:px-10 sm:py-10 space-y-6">
        <h2 class="text-3xl font-extrabold text-center text-indigo-700">➕ Add Expense</h2>

        <!-- Success or Error Message -->
        <?php if (isset($success)): ?>
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg text-sm text-center font-semibold">
                <?= $success ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg text-sm text-center font-semibold">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <!-- Form Start -->
        <form method="POST" class="space-y-5">
            <!-- Reason -->
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Expense Reason</label>
                <input type="text" name="reason" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition" required>
            </div>

            <!-- Amount -->
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Amount (৳)</label>
                <input type="number" step="0.01" name="amount" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition" required>
            </div>

            <!-- Date -->
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Date</label>
                <input type="date" name="date"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="add_expense"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                💾 Save Expense
            </button>
        </form>

        <!-- Back Button -->
        <div class="text-center">
            <a href="view_expense.php" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 text-sm font-medium transition">
                🔙 Back to Expenses
            </a>
        </div>
    </div>

</body>
</html>
