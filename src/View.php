<?php

namespace App;

class View {
    public function __construct(protected string $view){}

    public static function show(string $view, array $params = []): string {
        // $viewPath is included in mainView.php
        $viewPath = VIEW_PATH . '/' . $view . '.php';
        $mainView = VIEW_PATH . '/' . 'mainView.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: {$viewPath}");
        }

        ob_start();

        if (count($params) > 0) {
            foreach($params as $key => $value) {
                $$key = $value;
            }
        }

        include $mainView;

        return (string) ob_get_clean();
    }
}