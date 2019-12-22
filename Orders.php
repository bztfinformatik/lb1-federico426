<?php

class Orders extends Controller
{

    private $menueArray = array();
    private $orderArray = array();
    private $user;

    public function index($name = '')
    {
        /**
         * Hier könnte eine allgemeine Übersichts-Auswertung der aktuellen Auslastung der
         * Mense platziert werden
         */
        echo $this->twig->render('order/index.twig.html', ['title' => "Order - Placement / Index", 'urlroot' => URLROOT]);
    }

    public function add()
    {
        $orderModel = $this->model('OrderModel');
        $menueModel = $this->model('MenueModel');
        $menueArray = $menueModel->getFakeMenueDataArray();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Form -> weil Post-Aufruf

            // Zuerst mal trimen und filtern auf Gesunde Daten
            $username = trim(
                filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)
            );
            $comment = trim(
                filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING)
            );
            $email = trim(
                filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)
            );
            $refmenue = trim(
                filter_input(INPUT_POST, 'refmenue', FILTER_SANITIZE_NUMBER_INT)
            );

            // Daten setzen
            $data = [
                'username' => $username,       // Form-Feld-Daten
                'username_err' => '',   // Feldermeldung für Attribute
                'email' => $email,          // Form-Feld-Daten
                'email_err' => '',      // Feldermeldung für Attribute
                'refmenue' => $refmenue,       // Form-Feld-Daten
                'refmenue_err' => '',   // Feldermeldung für Attribute
                'comment' => $comment       // Form-Feld-Daten
            ];


            // Gucken ob die Daten plausibel sind
            // Da müsste man aber noch mehr machen
            
            if(empty($data['username']))
            {
                $data['username_err'] = 'Bitte Name angeben';
            }

            if(empty($data['email']))
            {
                $data['email_err'] = 'Bitte Email angeben';
            }

            if(empty($data['refmenue']))
            {
                $data['refmenue_err'] = 'Bitte Menü auswählen';
            }

            // Keine Errors vorhanden
            if (empty($data['username_err']) && empty($data['email_err']) && empty($data['refmenue_err']))
            {
                // Alles gut, keine Fehler vorhanden
                // Späteres TODO: Auf DB schreiben
                //die('SUCCESS');
                $orderModel->fakewriteData($data);
            }
            else {
                // Fehler vorhanden - Fehler anzeigen
                // View laden mit Fehlern

                echo $this->twig->render('order/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data, 'menues' => $menueArray]);
            }

        } else {
            // Init Form mit Default-Daten, weil Get-Aufruf

            $data = [
                'username' => '',       // Form-Feld-Daten
                'username_err' => '',   // Feldermeldung für Attribute
                'email' => '',          // Form-Feld-Daten
                'email_err' => '',      // Feldermeldung für Attribute
                'refmenue' => '',       // Form-Feld-Daten
                'refmenue_err' => '',    // Feldermeldung für Attribute
                'comment' => ''       // Form-Feld-Daten
            ];

            echo $this->twig->render('order/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data, 'menues' => $menueArray]);
        }
    }

    public function listmyorders()
    { 
        // Diese Var wird in Zukunft aus der Session kommen...so wie eingeloggt, so ist die Userid.
        $userid = 1;


        $orderModel = $this->model('OrderModel');
        $menueModel = $this->model('MenueModel');
        $menueArray = $menueModel->getFakeMenueDataArray();
        $orderArray = $orderModel->getFakeOrderDateForUserID($userid);

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




        echo $this->twig->render('order/list.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data]);
    }
}
