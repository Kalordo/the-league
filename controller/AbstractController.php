<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected Environment $twig;
    
    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '../templates/');
        $this->twig = new Environment($loader);
    }
    
    protected function render(string $template, array $data = []): void
    {
        echo $this->twig->render($template, $data);
    }
    
    protected function redirect(string $route): void
    {
        header('Location: index.php?route=' . $route);
        exit;
    }
    
    protected function redirectToHome(): void
    {
        header('Location: index.php');
        exit;
    }
}

?>