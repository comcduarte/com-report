<?php
namespace Report\Form;

use Components\Form\AbstractBaseForm;
use Laminas\Form\Element\Hidden;

class ReportRequestForm extends AbstractBaseForm
{
    public $num_vars = 0;
    
    public function init()
    {
        parent::init();
        
        $this->add([
            'name' => 'NUM_VARS',
            'type' => Hidden::class,
            'attributes' => [
                'id' => 'NUM_VARS',
                'class' => 'form-control',
                'required' => 'true',
                'value' => $this->num_vars,
            ],
            'options' => [
                'label' => 'UUID',
            ],
        ],['priority' => 0]);
        
        for ($i = 0; $i < $this->num_vars; $i++) {
            $this->add([
                'name' => 'FIELD' . $i,
                'type' => Hidden::class,
                'attributes' => [
                    'id' => 'FIELD' . $i,
                    'class' => 'form-control',
                    'required' => 'true',
                ],
            ],['priority' => 0]);
            
            $this->add([
                'name' => 'VALUE' . $i,
                'type' => Hidden::class,
                'attributes' => [
                    'id' => 'VALUE' . $i,
                    'class' => 'form-control',
                    'required' => 'true',
                ],
            ],['priority' => 0]);
        }
    }
}