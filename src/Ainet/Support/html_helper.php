<?php

function escape($raw)
{
    return htmlentities($raw, ENT_QUOTES, 'UTF-8');
}

function input_value($name, $default = null)
{
    if (array_key_exists($name, $_POST)) {
        return $_POST[$name];
    }

    return $default;
}

function old($name, $default = '')
{
    if (isset($_POST[$name])) {
        return $_POST[$name];
    }

    return $default;
}

function is_selected($name, $value, $default = null, $result = 'selected')
{
    if (isset($_POST[$name]) && $_POST[$name] === $value) {
        return $result;
    }
    if ("$default" === "$value") {
        return $result;
    }

    return '';
}

function render_view($viewName, $vars)
{
    // Declares a local variable for each pair inside $vars
    foreach ($vars as $name => $value) {
        $$name = $value;
    }

    include 'src/views/admin/admin_nav.view.php';
    include 'src/views/admin/admin_header.view.php';
    include 'src/views/'.str_replace('.', '/', $viewName).'.view.php';
    include 'src/views/admin/admin_footer.view.php';
}
