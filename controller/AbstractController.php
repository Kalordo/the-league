<?php

use Twig\Environment;

abstract class AbstractController
{
    protected Environment $twig;
    
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../templates/');
        $this->twig = new Twig\Environment($loader);
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