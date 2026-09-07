<?php
if (!function_exists('generate_view_button')) {
    function generate_view_button(string $url, string $class = '', string $text = ''): string
    {
        return sprintf(config('buttons.view'), $url, $class, $text);
    }
}

if (!function_exists('generate_edit_button')) {
    function generate_edit_button(string $url, string $class = '', string $text = ''): string
    {
        return sprintf(config('buttons.edit'), $url, $class, $text);
    }
}

if (!function_exists('generate_delete_button')) {
    function generate_delete_button(string $url, string $class = '', string $text = ''): string
    {
        return sprintf(config('buttons.delete'), $url, $class, $text);
    }
}

if (!function_exists('generate_back_to_list_button')) {
    function generate_back_to_list_button(string $url, string $class = '', string $text = ''): string
    {
        return sprintf(config('buttons.back_to_list'), $url, $class, $text);
    }
}
if (!function_exists('generate_back_to_list_button')) {
    function generate_back_to_list_button(string $url, string $class = '', string $text = ''): string
    {
        return sprintf(config('buttons.back_to_list'), $url, $class, $text);
    }
}

if (!function_exists('generate_add_button')) {
    function generate_add_button(string $url, string $class = '', string $title = '', string $text = ''): string
    {
        return sprintf(config('buttons.add_new'), $url, $class, $title, $text);
    }
}

if (!function_exists('generate_submit_reset_button')) {
    function generate_submit_reset_button(): string
    {
        return '<div class="mb-3 rounded">
                <div class="row justify-content-start g-2">
                <div class="col-md-2">' .
            config('buttons.submit_btn') . '</div><div class="col-md-2">' . config('buttons.reset_btn')
            . '
                </div></div></div>';
    }
}
