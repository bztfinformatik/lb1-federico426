<?php

class Forms extends Controller
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
        echo $this->twig->render('form/index.twig.html', ['title' => "Spesen - Placement / Index", 'urlroot' => URLROOT]);
    }

    public function add()
    {
        $formModel = $this->model('FormModel');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Form -> weil Post-Aufruf

            // Zuerst mal trimen und filtern auf Gesunde Daten


            $name = trim(
                filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)
            );
            $lastname = trim(
                filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)
            );
            $datefrom = trim(
                filter_input(INPUT_POST, 'datefrom', FILTER_SANITIZE_STRING)
            );
            $dateto = trim(
                filter_input(INPUT_POST, 'dateto', FILTER_SANITIZE_STRING)
            );
            $event = trim(
                filter_input(INPUT_POST, 'event', FILTER_SANITIZE_STRING)
            );
            $company = trim(
                filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING)
            );
            $zip = trim(
                filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING)
            );
            $location = trim(
                filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING)
            );
            $dateform1 = trim(
                filter_input(INPUT_POST, 'dateform1', FILTER_SANITIZE_STRING)
            );
            $product1 = trim(
                filter_input(INPUT_POST, 'product1', FILTER_SANITIZE_STRING)
            );
            $price1 = trim(
                filter_input(INPUT_POST, 'price1', FILTER_SANITIZE_STRING)
            );
            $VAT1 = trim(
                filter_input(INPUT_POST, 'VAT1', FILTER_SANITIZE_STRING)
            );




            // Daten setzen
            $data = [
                'name' => $name,       // Form-Feld-Daten
                'name_err' => '',
                'lastname' => $lastname,       // Form-Feld-Daten
                'lastname_err' => '',
                'datefrom' => $datefrom,
                'datefrom_err' => '',
                'dateto' => $dateto,
                'dateto_err' => '',
                'event' => $event,       // Form-Feld-Daten
                'event_err' => '',
                'company' => $company,       // Form-Feld-Daten
                'company_err' => '',
                'zip' => $zip,       // Form-Feld-Daten
                'zip_err' => '',
                'location' => $location,       // Form-Feld-Daten
                'location_err' => '',
                'dateform1' => $dateform1,
                'dateform1_err' => '',
                'product1' => $product1,
                'product1_err' => '',
                'price1' => $price1,
                'price1_err' => '',
                'VAT1' => $VAT1,
                'VAT1_err' => '',
                'dateform2' => $dateform2,
                'dateform2_err' => '',
                'product2' => $product2,
                'product2_err' => '',
                'price2' => $price2,
                'price2_err' => '',
                'VAT2' => $VAT2,
                'VAT2_err' => '',
                'dateform3' => $dateform3,
                'dateform3_err' => '',
                'product3' => $product3,
                'product3_err' => '',
                'price3' => $price3,
                'price3_err' => '',
                'VAT3' => $VAT3,
                'VAT3_err' => '',
                'dateform4' => $dateform4,
                'dateform4_err' => '',
                'product4' => $product4,
                'product4_err' => '',
                'price4' => $price4,
                'price4_err' => '',
                'VAT4' => $VAT4,
                'VAT4_err' => '',
                'dateform5' => $dateform5,
                'dateform5_err' => '',
                'product5' => $product5,
                'product5_err' => '',
                'price5' => $price5,
                'price5_err' => '',
                'VAT5' => $VAT5,
                'VAT5_err' => ''

            ];


            // Gucken ob die Daten plausibel sind
            // Da müsste man aber noch mehr machen
            
            if(empty($data['name']))
            {
                $data['name_err'] = 'Bitte Name angeben';
            }

            if(empty($data['lastname']))
            {
                $data['lastname_err'] = 'Bitte Nachname angeben';
            }

            if(empty($data['event']))
            {
                $data['event'] = 'Bitte Anlass angeben';
            }

            if(empty($data['company']))
            {
                $data['company'] = 'Bitte Firma angeben';
            }

            if(empty($data['datefrom']))
            {
                $data['datefrom_err'] = 'Bitte Datum angeben';
            }

            if(empty($data['dateto']))
            {
                $data['dateto_err'] = 'Bitte Datum angeben';
            }

            if(empty($data['zip']))
            {
                $data['zip_err'] = 'Bitte PLZ angeben';
            }

            if(empty($data['location']))
            {
                $data['location_err'] = 'Bitte Ort angeben';
            }



            // Keine Errors vorhanden
            if (empty($data['name_err']) && empty($data['lastname_err']) && empty($data['event_err']) && empty($data['company_err']) )
            {
                // Alles gut, keine Fehler vorhanden
                // Späteres TODO: Auf DB schreiben
                //die('SUCCESS');
                $formModel->fakewriteData($data);
            }
            else {
                // Fehler vorhanden - Fehler anzeigen
                // View laden mit Fehlern

                echo $this->twig->render('form/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data, 'menues' => $menueArray]);
            }

        } else {
            // Init Form mit Default-Daten, weil Get-Aufruf

            $data = [
                'name' => '',       // Form-Feld-Daten
                'name_err' => '',
                'lastname' => '',       // Form-Feld-Daten
                'lastname_err' => '',
                'datefrom' => '',
                'dateto' => '',
                'event' => '',       // Form-Feld-Daten
                'event_err' => '',
                'company' => '',       // Form-Feld-Daten
                'company_err' => '',
                'zip' => '',       // Form-Feld-Daten
                'zip_err' => '',
                'location' => '',       // Form-Feld-Daten
                'location_err' => ''       // Form-Feld-Daten
            ];

            echo $this->twig->render('form/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data, 'menues' => $menueArray]);
        }
        header("Location: http://localhost:8000/public/Formadmin/");
    }

    public function change(){
       $formModel = $this->model('FormModel');
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        //var_dump($_POST);

        //echo $id;
        $formModel->acceptSet($id);


       }else {
        echo "No Post";
       }
    header("Location: http://localhost:8000/public/Formadmin/");
    }
}
