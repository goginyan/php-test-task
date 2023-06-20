<?php

class TextController
{
    public function index()
    {
        $this->setCSRF();

        require_once('Views/form.php');
    }

    public function create()
    {
        require_once('Models/Text.php');
        require_once('Services/EmailService.php');
        require_once('Services/SmsService.php');
        if (! $this->verifyCSRF($_POST['_CSRF'])) {
            echo "Invalid CSRF token";
            exit();
        }

        $textModel = new Text();
        $textModel->create($_POST['text']);
        (new SmsService())->send('New Submission');
        (new EmailService())->send('New Submission');

        require_once('Views/show.php');
    }

    private function setCSRF()
    {
        session_start();

        $_SESSION['_CSRF'] = md5(rand());
    }

    private function verifyCSRF($token)
    {
        session_start();

        return $_SESSION['_CSRF'] === $token;
    }
}