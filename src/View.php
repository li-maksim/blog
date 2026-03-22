<?php

declare(strict_types = 1);
namespace App;

class View {
    public function __construct(protected string $view){}

    public static function show(string $view, array $params = [], bool $partial = false): string {
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

        if (!$partial) {
            include $mainView;
        } else {
            // An option to render not the full view, but individual component
            include $viewPath;
        }

        return (string) ob_get_clean();
    }
}