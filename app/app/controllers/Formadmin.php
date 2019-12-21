<?php

class Formadmin extends Controller
{
    private $listingsArray = array();
    private $formArray = array();


    public function index($name = '')

    {

        $formModel = $this->model('FormModel');
        $listingsModel = $this->model('ListingsModel');
        $listingsArray = $listingsModel->getListingsDataArray();
        $formArray = $formModel->getFormData();
        $formModel = $this->model('FormModel');

        $data = [];
        foreach($formArray as $form)
        {
            $orderrow = [];
            foreach ($form as $key => $value) {
                {
                    
                    foreach($listingsArray as $listing){
                        
                        if ($listing['formid'] == $value)
                        {
                            echo var_dump();
                            $orderrow['details'] = $listing['description'] . "," . $listing['price'];
                        }
                    }
                }

                // alle anderen Dinge einfach rüberkopieren
                $orderrow[$key] = $value;
            }
            

            array_push($data, $orderrow);
        }

        echo $this->twig->render('formadmin/index.twig.html', ['title' => "Order - Listing", 'urlroot' => URLROOT, 'data' => $data] );                
    }
}