<?php
namespace Report\Controller;

use Components\Controller\AbstractBaseController;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\View\Model\ViewModel;
use Report\Form\ReportRequestForm;
use Report\Model\ReportModel;
use Exception;

class ReportController extends AbstractBaseController
{
    public function indexAction()
    {
        $view = new ViewModel();
        $view = parent::indexAction();
        $view->setTemplate('report/report/index.phtml');
        return $view;
    }
    
    public function viewAction()
    {
        $view = new ViewModel();
        
        $this->layout('layout/report');
        
        
        $uuid = $this->params()->fromRoute('uuid',0);
        $data = NULL;
        $i = 0;
        
        $request = $this->getRequest();
        $form = new ReportRequestForm();
        if ($request->isPost()) {
            $data = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
                );
            $form->setData($data);
            
            if ($form->isValid()) {
                $uuid = $data['UUID'];
            }
        }
        
        if (!$uuid) {
            throw new \Exception('Missing UUID');
        }
        
        $report = new ReportModel($this->adapter);
        $report->read(['UUID' => $uuid]);
        
        $revised_code = "";
        
        $vars = [];
        if (isset($data['NUM_VARS'])) {
            for ($i = 0; $i < $data['NUM_VARS']; $i++) {
                $vars[] = $data['FIELD' . $i];
                $vars[] = $data['VALUE' . $i];
            }
            $revised_code = vsprintf($report->CODE, $vars);
        } else {
            $revised_code = $report->CODE;
        }
        
        
        $statement = $this->adapter->createStatement($revised_code);
        
        try {
            $resultSet = new ResultSet();
            $data = $statement->execute();
            $resultSet->initialize($data);
        } catch (Exception $e) {
            return $e;
        }
        
        $view->setVariable('report', $report);
        $view->setVariable('data', $resultSet->toArray());
        $view->setVariable('view', $report->VIEW);
        $view->setVariable('title', $report->NAME);
        
        return $view;
    }
}