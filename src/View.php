<?php

namespace App;

class View {
    public function __construct(protected string $view){}

    public static function show(string $view): string {
        $viewPath = VIEW_PATH . '/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }

        ob_start();

        include $viewPath;

        return (string) ob_get_clean();
    }
}