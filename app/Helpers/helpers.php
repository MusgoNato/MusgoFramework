<?php

/**
 * Summary of view
 * @param string $view
 * @param string|array $props
 * @throws Exception
 * @return bool|string
 */
function view(string $view, string|array $props = [])
{
    // 
    $view_namespace = VIEW_BASE_PATH . $view . ".php";

    if(!file_exists($view_namespace))
    {
        throw new Exception("View {$view} não existe!");
    }

    // Extrai as variaveis colocadas dentro da funcao
    extract($props, EXTR_SKIP);

    ob_start();
    require $view_namespace;
    return ob_get_clean();
}

/**
 * Summary of e
 * @param mixed $value
 * @return string
 */
function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
