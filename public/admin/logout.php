<?php

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'bootstrap.php');
redirect_unless_admin();
if (!is_post()) {
   abort_404();
}
unset($_SESSION['admin']);
redirect("/public/admin/login.php");
