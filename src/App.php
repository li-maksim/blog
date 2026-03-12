<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\RouteNotFound;

class App {

    public function __construct(protected Router $router, protected array $request){}

    public function run() {
        try {
            echo $this->router->resolve($this->request['path'], strtolower($this->request['method']));
        } catch(RouteNotFound) {
            http_response_code(404);

            echo View::show('404');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            echo "<p>Sorry, internal error: <br> $msg</p>";
        }
    }
}

