<?php
partial('header', ['title' => "$title - Admin Panel"]);
?>
<div class="flex max-w-5xl mx-auto mt-8">
    <nav class="mr-6 p-6 mt-8 w-48 flex-shrink-0  border rounded">
        <div class=" -my-1">
            <div class="w-full my-1 py-2 px-3 rounded text-gray-800 text-center <?php actived('dashboard/index'); ?> hover:text-white hover:bg-gray-400">
                <a href="/public/admin/dashboard/index.php">Dashboard</a>
            </div>
            <div class="w-full my-1 py-2 px-3 rounded text-gray-800 text-center <?php actived('products/index'); ?> hover:text-white hover:bg-gray-400">
                <a href="/public/admin/products/index.php">Products</a>
            </div>
            <div class="w-full my-1 py-2 px-3 rounded text-gray-800 text-center <?php actived('statistics'); ?> hover:text-white hover:bg-gray-400">
                <a href="/public/admin/statistics.php">Statistics</a>
            </div>
            <div class="w-full my-1 py-2 px-3 rounded text-gray-800 text-center hover:text-white hover:bg-gray-400">
                <a href="#">Lien 1</a>
            </div>
            <div class="w-full my-1 py-2 px-3 rounded text-gray-800 text-center hover:text-white hover:bg-gray-400">
                <a href="#">Lien 1</a>
            </div>
            <div class="w-full my-1 py-2 px-3 rounded text-orange-800 border border-red-200 text-center hover:text-white hover:bg-red-400">
                <form action="/public/admin/logout.php" method="post">
                    <button type="submit" class="text-center p-1 outline-none focus:outline-none">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <main class="bg-white shadow-xl p-8 mt-8 w-full">
        <?php if ($flash = get_flash()) : ?>
            <div class="absolute right-0">
                <p class="mt-8 mr-12 px-12 py-2 max-w-sm <?= $flash['type'] === 'success' ? ' bg-green-100 text-green-900' : ''; ?>">
                    <?= $flash['message']; ?>
                </p>
            </div>
        <?php endif; ?>