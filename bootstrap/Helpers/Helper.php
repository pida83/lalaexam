<?php
namespace bootstrap\Helpers;

use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

class Helper {
    private $twig;
    private $loader;

    public function viewRender($path = "", $list = array()) {
        $loader = new FilesystemLoader(resource_path("templates"));
        $twig = new Environment($loader, [
            'debug' => true,
            #'cache' => resource_path("templates")."/cache",
            'cache' => false
        ]);

        $template = $twig->load($path);

        return $template->render($list);
    }

}
