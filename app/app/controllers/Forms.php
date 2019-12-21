<?php

class Forms extends Controller
{

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

            $email = $_SESSION['user_email'];
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
                'email' => $email,
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
                'location_err' => ''
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


            echo "wir sind hier <br>";
            // Keine Errors vorhanden
            if (empty($data['name_err']) && empty($data['lastname_err']) && empty($data['event_err']) && empty($data['company_err']) )
            {
                // Alles gut, keine Fehler vorhanden
                // Späteres TODO: Auf DB schreiben
                //die('SUCCESS');
                echo "wir sind hier <br>";
                $formModel->writeData($data);
            }
            else {
                // Fehler vorhanden - Fehler anzeigen
                // View laden mit Fehlern
                echo $this->twig->render('form/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data]);
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
