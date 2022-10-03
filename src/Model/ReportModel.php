<?php
namespace Report\Model;

use Components\Model\AbstractBaseModel;
use Laminas\Db\Adapter\Adapter;

class ReportModel extends AbstractBaseModel
{
    public $NAME;
    public $CODE;
    public $VIEW;
    public $FUNC;
    
    public function __construct(Adapter $adapter)
    {
        parent::__construct($adapter);
        $this->setTableName('reports');
    }
}