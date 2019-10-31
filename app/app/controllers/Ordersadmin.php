<?php

class Ordersadmin extends Controller
{
    private $menueArray = array();
    private $orderArray = array();


    public function index($name = '')
    {
        $orderModel = $this->model('OrderModel');
        $menueModel = $this->model('MenueModel');
        $menueArray = $menueModel->getFakeMenueDataArray();
        $orderArray = $orderModel->getFakeOrderData();

        // Anstatt Dinge in der GUI kompliziert zu machen, bauen wir hier die Dinge so zusammen wie 
        // wir sie brauchen
        // Diesen Array wollen wir zusammenbauen, dann der GUI übergeben
        // ABER : Solches Zeug ist eigentlich idealer/performanter auf dem Model zu erledigen!
        
        $data = [];
        foreach($orderArray as $order)
        {
            $orderrow = [];
            foreach ($order as $key => $value) {

                // für jede Bestellung noch das Menü rausfipseln
                if ($key == 'refmenue')
                {
                    
                    foreach($menueArray as $menue){
                        
                        if ($menue['id'] == $value)
                        {
                            //echo var_dump();
                            $orderrow['menueinfo'] = $menue['title'] . "," . $menue['description'];
                        }
                    }
                }

                // alle anderen Dinge einfach rüberkopieren
                $orderrow[$key] = $value;
            }

            array_push($data, $orderrow);
        }

        echo $this->twig->render('orderadmin/index.twig.html', ['title' => "Order - Listing", 'urlroot' => URLROOT, 'data' => $data] );                
    }
}