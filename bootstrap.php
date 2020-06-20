<?php
ini_set('display_errors', 1);
set_error_handler(function ($severity, $message, $file, $line) {
    throw new \ErrorException($message, $severity, $severity, $file, $line);
});
session_start();

function partial(string $__name, array $params = [])
{
    extract($params);
    require(__DIR__ . DIRECTORY_SEPARATOR . "html_partials" . DIRECTORY_SEPARATOR . "{$__name}.html.php");
}
function is_post()
{
    return ($_SERVER['REQUEST_METHOD'] ?? 'CLI') === 'POST';
}
function redirect($url)
{
    header("Location:  $url");
    die();
}

function redirect_self()
{
    redirect($_SERVER['REQUEST_URI']);
}

function redirect_unless_admin()
{
    if (!($_SESSION['admin'] ?? null)) {
        redirect('login');
    }
}

function abort_404()
{
    http_response_code(404);
    echo "Page 404";
    die();
}

function is_on_page($page = null)
{
    $pieces = explode("/", $_SERVER['SCRIPT_NAME']);
    return  $pieces[3] . "/" . $pieces[4] === $page . '.php';
}

function is_on_directory($directory = null)
{
    strpos($_SERVER['SCRIPT_NAME'], $directory) === 0;
}

function actived($page)
{
    $page = strtolower($page);
    echo is_on_page($page) ? 'bg-gray-400' : '';
}

function import($lib)
{
    require_once __DIR__ . "/libs/{$lib}.php";
}

function get_words($sentence, $count = 10)
{
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

function save_inputs()
{
    foreach ($_POST as $key => $value) {
        if (in_array($key, ['password'])) {
            continue;
        }
    }
    $_SESSION['previous_inputs'] = $_SESSION['previous_inputs'] ?? null;
    $_SESSION['previous_inputs'][$key] = $value;
}

function get_previous_inputs()
{
    static $previous_inputs;
    if ($previous_inputs) {
        return $previous_inputs;
    }
    $previous_inputs = $_SESSION['previous_inputs'] ?? [];
    $_SESSION['previous_inputs'] = [];
    return $previous_inputs;
}

function get_previous_input($key)
{
    return get_previous_inputs()[$key] ?? null;
}
import('flash');
import('validation');
import('database');
