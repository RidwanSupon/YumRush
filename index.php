<?php
session_start();
require_once 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin/dashboard.php');
        exit;
    } else {
        $error = "❌ Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login - Yum Rush</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-yellow-100 to-orange-200 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white p-6 rounded-2xl shadow-xl max-w-sm w-full">
        <h2 class="text-2xl font-bold text-center text-orange-600 mb-4">🍔 Yum Rush Admin</h2>
        <p class="text-center text-gray-600 mb-6">Please login to access your dashboard</p>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            </div>

            <?php if (isset($error)): ?>
                <p class="text-sm text-red-600"><?= $error ?></p>
            <?php endif; ?>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg font-semibold shadow transition duration-200">
                🔐 Login
            </button>
        </form>

        <!-- <div class="mt-4 text-center">
            <a href="register_admin.php" class="text-blue-600 hover:underline text-sm">➕ Register New Admin</a>
        </div> -->
    </div>

</body>
</html>
