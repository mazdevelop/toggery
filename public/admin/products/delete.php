<?php
require_once(__DIR__ .  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php');
redirect_unless_admin();
import('products');
if (!is_post()) {
    abort_404();
}
$product = find_product($_GET['id']);
$query = pdo()->prepare('DELETE FROM products WHERE id= ?');
$query->execute([$product->id]);
flash_success("The product << {$product->name} >> has been deleted");
redirect('/public/admin/products/index.php');
