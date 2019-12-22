<?php

class Formadmin extends Controller
{
    private $formArray = array();
    public function index($name = '')

    {
        if (isset($_SESSION['user_id'])) {
            $uservariables = $_SESSION;
            $formModel = $this->model('FormModel');
            $listingsModel = $this->model('ListingsModel');
            $data = $formModel->getFormData($_SESSION);
            foreach($data as $key => $item) {
                $total = $listingsModel->getEntryTotal($listingsModel->getEntries($item['id']));
                $data[$key]['total'] = $total;
            };

            $roles = $_SESSION['user_roles'];
            if (in_array("admin", $roles)) {
                $uservariables['isAdmin'] = true;
            }

            echo $this->twig->render('formadmin/index.twig.html', ['title' => "Order - Listing", 'urlroot' => URLROOT, 'data' => $data, 'uservariables' => $uservariables] );
                
        }else{
            redirect('Users/Login');
        }                
    }
}