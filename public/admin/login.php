<?php
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php');
if (is_post()) {
    $query = pdo()->prepare('SELECT * FROM admins WHERE name=?');
    $query->execute([$_POST['name']]);
    $admin = $query->fetch();
    if (!$admin or !password_verify($_POST['password'], $admin['password'])) {
        $_SESSION['previous_errors']['credentials']  = 'incorrect credentials';
        save_inputs();
        redirect('/public/admin/login.php');
    } else {
        if (!isset($_SESSION['admin'])) {
            $_SESSION['admin'] = $admin;
        }
        redirect("/public/admin/dashboard/index.php");
    }
}
?>
<?php partial('header', ['title' => 'Admin Login']); ?>
<div class="min-h-screen min-w-screen flex justify-center items-center">
    <div class="bg-gray-200 shadow-lg p-16 -mt-8">
        <h1 class="text-xl mb-4 text-center">Admin Login</h1>
        <form method="post">
            <?php if (get_previous_error('credentials')) : ?>
                <p class="border border-red-900 w-full bg-red-100 text-red-900 p-3 text-center mb-3">
                    <?= get_previous_error('credentials'); ?>
                </p>
            <?php endif; ?>
            <p class="mb-4">

                <label for="name" class="block text-sm mb-2">Last name</label>
                <input type="text" name="name" id="name" class="border outline-none rounded-sm focus:border-black  px-3  py-1 w-full" value="<?= get_previous_input('name') ?? ''; ?>">
            </p>
            <p class="mt-4">
                <label for="password" class="block text-sm mb-2">Password</label>
                <input type="text" name="password" id="password" class="border outline-none rounded-sm focus:border-black px-3 py-1 w-full" required>
            </p>
            <p>
                <button type="submit" class="w-full transition ease-linear border py-1 mt-4 hover:">Login</button>
            </p>
        </form>
    </div>
</div>
<?php partial('footer'); ?>