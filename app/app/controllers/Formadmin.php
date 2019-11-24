<?php

class Formadmin extends Controller
{
    private $listingsArray = array();
    private $formArray = array();


    public function index($name = '')

    {

        $formModel = $this->model('FormModel');
        $listingsModel = $this->model('ListingsModel');
        $listingsArray = $listingsModel->getFakeListingsDataArray();
        $formArray = $formModel->getFakeFormData();
        //var_dump($formArray);
        $formModel = $this->model('FormModel');
        //$formArray = $formModel->getFakeFormData();

        // Anstatt Dinge in der GUI kompliziert zu machen, bauen wir hier die Dinge so zusammen wie 
        // wir sie brauchen
        // Diesen Array wollen wir zusammenbauen, dann der GUI übergeben
        // ABER : Solches Zeug ist eigentlich idealer/performanter auf dem Model zu erledigen!
        
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