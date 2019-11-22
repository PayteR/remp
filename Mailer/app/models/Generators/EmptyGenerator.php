<?php

namespace Remp\MailerModule\Generators;

use Nette\Application\UI\Form;
use Nette\Utils\ArrayHash;

class EmptyGenerator implements IGenerator
{
    public $onSubmit;

    public function generateForm(Form $form)
    {
        $form->onSuccess[] = [$this, 'formSucceeded'];
    }

    public function formSucceeded($form, $values)
    {
    }

    public function onSubmit(callable $onSubmit)
    {
        $this->onSubmit = $onSubmit;
    }

    public function getWidgets()
    {
        return [];
    }

    public function apiParams()
    {
        return [];
    }

    public function process($input)
    {
        return [];
    }

    public function preprocessParameters($data): ?ArrayHash
    {
        return null;
    }
}
