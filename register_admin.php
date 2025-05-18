<?php
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashedPassword);

        if ($stmt->execute()) {
            $success = "✅ Admin registered successfully!";
        } else {
            $error = "❌ Username might already exist!";
        }
    } else {
        $error = "❌ All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Admin - Yum Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-orange-100 to-yellow-200 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white p-6 rounded-2xl shadow-xl max-w-sm w-full">
        <h2 class="text-2xl font-bold text-center text-orange-600 mb-4">👤 Register Admin</h2>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <?php if (isset($success)): ?>
                <p class="text-sm text-green-600"><?= $success ?></p>
            <?php elseif (isset($error)): ?>
                <p class="text-sm text-red-600"><?= $error ?></p>
            <?php endif; ?>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-semibold shadow transition duration-200">
                ✅ Register
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="index.php" class="text-blue-600 hover:underline text-sm">🔐 Go to Login</a>
        </div>
    </div>
</body>
</html>
