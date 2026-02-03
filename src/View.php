<?php

namespace App;

class View {
    public function __construct(protected string $view){}

    public static function show(string $view, array $params = []): string {
        $viewPath = VIEW_PATH . '/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }

        ob_start();

        if (count($params) > 0) {
            foreach($params as $key => $value) {
                $$key = $value;
            }
        }

        include $viewPath;

        return (string) ob_get_clean();
    }
}