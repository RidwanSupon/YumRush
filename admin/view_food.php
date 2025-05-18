<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';

// Delete single food item via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = intval($_POST['delete_id']);
    $conn->query("DELETE FROM food_items WHERE id = $id");
    header("Location: view_food.php");
    exit;
}

// Clear all via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_all'])) {
    $conn->query("DELETE FROM food_items");
    header("Location: view_food.php");
    exit;
}

$foods = $conn->query("SELECT * FROM food_items");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Food Items - Yum Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-orange-100 to-yellow-200 min-h-screen px-2 sm:px-4 py-4">

<div class="max-w-7xl mx-auto bg-white shadow-lg rounded-2xl p-4 sm:p-6 md:p-10">
    <h2 class="text-xl sm:text-3xl font-extrabold text-center text-gray-800 mb-6 sm:mb-8">🍱 Food Items List</h2>

    <!-- Clear All Button -->
    <form method="POST" onsubmit="return confirm('Are you sure you want to delete ALL food items?')" class="text-right mb-4">
        <button type="submit" name="clear_all"
            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full text-xs sm:text-sm font-medium shadow-md">
            🧹 Clear All
        </button>
    </form>

    <div class="overflow-x-auto rounded-lg">
        <table class="min-w-full table-auto text-xs sm:text-sm text-left border-collapse">
            <thead class="bg-orange-200 text-gray-800">
                <tr>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 border-b text-center">Name</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 border-b text-center">Price</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 border-b text-center">Availability</th>
                    <th class="px-2 sm:px-4 py-2 sm:py-3 border-b text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php if ($foods->num_rows > 0): ?>
                    <?php while ($row = $foods->fetch_assoc()): ?>
                        <tr class="hover:bg-orange-50 transition duration-200">
                            <td class="px-2 sm:px-4 py-2 sm:py-3 border-b text-center"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 border-b text-center">৳<?= number_format($row['price'], 2) ?></td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 border-b text-center"><?= htmlspecialchars($row['availability']) ?></td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 border-b text-center">
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" class="inline">
                                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-full text-xs sm:text-sm shadow-md">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center px-2 sm:px-4 py-6 text-gray-500 text-sm">No food items found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="mt-4 sm:mt-6 text-center">
            <a href="dashboard.php" class="text-indigo-600 hover:underline text-sm font-medium">🔙 Back to Dashboard</a>
        </div>
    </div>
</div>
</body>
</html>
