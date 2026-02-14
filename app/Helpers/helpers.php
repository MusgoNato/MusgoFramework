<?php

use App\Chore\ConfigEnv;

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

/**
 * Summary of config
 * Método responsável pelo acesso a variáveis de configuração de ambiente
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function config(string $key, $default = null): mixed
{
    return ConfigEnv::get($key, $default);
}