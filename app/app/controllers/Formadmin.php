<?php

class Formadmin extends Controller
{
    private $formArray = array();


    public function index($name = '')

    {

        $formModel = $this->model('FormModel');
        $listingsModel = $this->model('ListingsModel');
        $formArray = $formModel->getFormData($_SESSION['user_email']);

        $data = [];
        foreach($formArray as $form)
        {
            $orderrow = [];
            foreach ($form as $key => $value) {
                $orderrow[$key] = $value;
            }            
            array_push($data, $orderrow);
        }
        echo $this->twig->render('formadmin/index.twig.html', ['title' => "Order - Listing", 'urlroot' => URLROOT, 'data' => $data] );                
    }
}