<?php
// require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/auth.php';

if (isset($_POST['add_sale'])) {
    $note = $_POST['note'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO sales (note, amount, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $note, $amount, $date);
    $stmt->execute();
    header("Location: view_sale.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale - Yum Rush</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-orange-100 to-yellow-200 min-h-screen flex justify-center items-center">

    <div class="w-full max-w-lg bg-white p-6 rounded-xl shadow-lg space-y-6">
        <h2 class="text-3xl font-extrabold text-center text-gray-800">Add Sale</h2>

        <form method="POST" class="space-y-4">
            <!-- Sale Note -->
            <div>
                <label for="note" class="block text-gray-700 font-medium">Sale Note</label>
                <input type="text" name="note" placeholder="Enter sale note" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            </div>

            <!-- Amount -->
            <div>
                <label for="amount" class="block text-gray-700 font-medium">Amount</label>
                <input type="number" step="0.01" name="amount" placeholder="Enter amount" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-gray-700 font-medium">Date</label>
                <input type="date" name="date" class="w-full p-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none" required>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <button type="submit" name="add_sale" class="w-full sm:w-auto bg-green-500 text-white px-6 py-3 rounded-lg text-lg hover:bg-green-600 transition duration-200">
                    Add Sale
                </button>
            </div>
        </form>
        <!-- Back Button -->
        <div class="text-center">
            <a href="view_sale.php" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 text-sm font-medium transition">
                🔙 Back to Sale
            </a>
        </div>
    </div>

</body>
</html>
