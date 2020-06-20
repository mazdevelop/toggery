<?php
require_once(__DIR__ .  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php');
redirect_unless_admin();
import('products');
$query = pdo()->query('SELECT * FROM products');
$products = $query->fetchAll(PDO::FETCH_CLASS, Product::class);
partial('header_admin', ['title' => 'Products']);
?>
<div class="flex items-center mb-4">
    <h1 class="text-xl ">Products</h1>
    <a href="/public/admin/products/add.php" class="ml-3 border px-2 py-1 uppercase text-xs">create product</a>
</div>
<div class="w-3/4 mx-auto">
    <div class="bg-white shadow-md rounded my-6">
        <table class="text-left w-full border-collapse">
            <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
            <thead>
                <tr>
                    <th class="py-4 px-6 bg-grey-100 font-bold uppercase text-sm text-grey-700 border-b border-grey-300">Name</th>
                    <th class="py-4 px-6 bg-grey-100 font-bold uppercase text-sm text-grey-700 border-b text-center border-grey-300">Description</th>
                    <th class="py-4 px-6 bg-grey-100 font-bold uppercase text-sm text-grey-700 border-b border-grey-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr class="hover:bg-gray-300">
                        <td class="py-4 px-2 border-b border-grey-300"><?= $product->name; ?></td>
                        <td class="py-4 px-2 border-b border-grey-300"><?= get_words($product->description) . '...'; ?></td>
                        <td class="py-4 px-2 border-b border-grey-300">
                            <div class="border border-b-2 border-l-0 border-t-0 border-r-0 py-2 border-indigo-400">
                                <a href="/public/admin/products/edit.php?id=<?= $product->id; ?>" class="text-gray-100 font-bold py-1 px-2 rounded text-xs bg-green-300 hover:bg-green-700">Edit</a>
                                <a href="/public/admin/products/" class="text-gray-100 font-bold py-1 px-2 rounded text-xs bg-blue-300 hover:bg-blue-700">View</a>
                            </div>
                            <form action="/public/admin/products/delete.php?id=<?= $product->id; ?>" method="POST" class="flex my-2">
                                <button class="text-gray-100  py-1 px-2 rounded text-xs bg-red-300 hover:bg-red-700">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?php partial('footer_admin'); ?>