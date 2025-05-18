<?php
// require_once '../includes/auth.php';
require_once '../includes/db.php';
require_once '../includes/auth.php';
if (isset($_POST['add_food'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $availability = $_POST['availability'];

    $stmt = $conn->prepare("INSERT INTO food_items (name, price, category, availability) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $name, $price, $category, $availability);
    $stmt->execute();
    header("Location: add_food.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Food Item - Yum Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-orange-100 to-yellow-200 min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-lg bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🍽️ Add New Food Item</h2>

        <?php if (isset($error)) echo "<p class='text-red-500 text-center mb-4'>$error</p>"; ?>

        <form method="POST" class="space-y-4">
            <input type="text" name="name" placeholder="Food Name"
                   class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>

            <input type="number" step="0.01" name="price" placeholder="Price"
                   class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>

            <input type="text" name="category" placeholder="Category"
                   class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>

            <select name="availability"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>
                <option value="">Select Availability</option>
                <option value="In Stock">In Stock</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>

            <button type="submit" name="add_food"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition duration-200">
                ➕ Add Food
            </button>
        </form>
        <!-- Back Button -->
        <div class="text-center">
            <a href="view_food.php" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 text-sm font-medium transition">
                🔙 Back to Food List
            </a>
        </div>
    </div>
</body>
</html>
