<?php
namespace Report\Form;

use Components\Form\AbstractBaseForm;
use Laminas\Form\Element\Text;
use Laminas\Form\Element\Textarea;

class ReportForm extends AbstractBaseForm
{
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'NAME',
            'type' => Text::class,
            'attributes' => [
                'id' => 'NAME',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Report Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'CODE',
            'type' => Textarea::class,
            'attributes' => [
                'id' => 'CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'SQL Statement',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'FUNC',
            'type' => Text::class,
            'attributes' => [
                'id' => 'FUNC',
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Function Name',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'VIEW',
            'type' => Text::class,
            'attributes' => [
                'id' => 'VIEW',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'PHTML File Location',
            ],
        ],['priority' => 100]);
    }
}