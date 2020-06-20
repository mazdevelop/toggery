<?php
require_once(__DIR__ .  DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php');
redirect_unless_admin();
partial('header_admin', ['title' => 'Products']);
import('categories');

$categories = get_all_categories();
if (is_post()) {

    validate([
        'category_id' => ['required'],
        'name' => ['required'],
        'description' => ['required'],
    ]);
    $query = pdo()->prepare('INSERT INTO products( category_id,name,description) VALUES (?,?,?)');
    $query->execute([$_POST['category_id'], $_POST['name'], $_POST['description']]);
    flash_success("The product << {$_POST['name']} >> has been registered");
    redirect('/public/admin/products/index.php');
}
?>

<h1 class="text-xl mb-4">Add a product</h1>
<form class="w-full max-w-lg" method="POST">
    <?= partial('admin_input', ['name' => 'name', 'label' => 'First Name']) ?>
    <?= partial('admin_textarea', ['name' => 'description', 'label' => 'Description']) ?>
    <?= partial('admin_select_model', [
        'name' => 'category_id', 'label' => 'Category',
        'options' => $categories, 'option_key_label' => 'name'
    ]) ?>
    <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <button class="shadow border border-red-200  
            focus:outline-none text-gray-900 font-bold py-2 px-12 rounded" type="submit">
                Add
            </button>
        </div>
    </div>
</form>

<?php partial('footer_admin'); ?>