<?php 

namespace Core\Form;

use Core\Form\FormError;

class FormResult
{
    //pn crée un tableau pour stocker les erreurs
    private array $form_errors = [];
    // on declare le constructeur avec un parametre par defaut 
    public function __construct(private string $success_message = '')
    {
    }
    //on crée son getter
    public function getSuccessMessage(): string
    {
        return $this->success_message;
    }

    public function getErrors(): array
    {
        return $this->form_errors;
    }

    public function hasError(): bool{
        return !empty($this->form_errors);
    }
    public function addError(FormError $error)
    {
        $this->form_errors[] = $error;
    }
}