<?php
require_once(__DIR__ .  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php');
redirect_unless_admin();
import('products');
import('categories');
$product = find_product($_GET['id']);
partial('header_admin', ['title' => 'Products']);

$categories = get_all_categories();
if (!$product) {
    abort_404();
}
if (is_post()) {
    validate([
        'category_id' => ['required'],
        'name' => ['required'],
        'description' => ['required'],
    ]);
    $query = pdo()->prepare('UPDATE products SET category_id=?, name=?,description=? WHERE id =?');
    $query->execute([$_POST['category_id'], $_POST['name'], $_POST['description'], $product->id]);
    flash_success("The product << {$product->name} >> has been modified");
    redirect("/public/admin/products/edit.php?id={$product->id}", "");
}
?>

<h1 class="text-xl mb-4">Edit
    <span class="text-sm">
        << </span> <?= $product->name; ?> <span class="text-sm">
            >>
    </span>
</h1>
<form class="w-full max-w-lg" method="POST">
    <?= partial('admin_input', ['name' => 'name', 'label' => 'First Name', 'model' => $product]) ?>
    <?= partial('admin_textarea', ['name' => 'description', 'label' => 'Description', 'model' => $product]) ?>
    <?= partial('admin_select_model', [
        'name' => 'category_id', 'label' => 'Category',
        'model' => $product, 'options' => $categories, 'option_key_label' => 'name'
    ]) ?>

    <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <button class="shadow border border-red-200  
            focus:outline-none text-gray-900 font-bold py-2 px-12 rounded" type="submit">
                Edit
            </button>
        </div>
    </div>
</form>

<?php partial('footer_admin'); ?>