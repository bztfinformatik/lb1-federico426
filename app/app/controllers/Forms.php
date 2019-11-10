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
        $menueModel = $this->model('MenueModel');
        $menueArray = $menueModel->getFakeMenueDataArray();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Form -> weil Post-Aufruf

            // Zuerst mal trimen und filtern auf Gesunde Daten
            $name = trim(
                filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING)
            );
            $lastname = trim(
                filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)
            );
            $event = trim(
                filter_input(INPUT_POST, 'event', FILTER_SANITIZE_STRING)
            );
            $company = trim(
                filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING)
            );
            $location = trim(
                filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING)
            );



            // Daten setzen
            $data = [
                'name' => $name,       // Form-Feld-Daten
                'name_err' => '',
                'lastname' => $lastname,       // Form-Feld-Daten
                'lastname_err' => '',
                'datefrom' => $datefrom,
                'dateto' => $dateto,
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

            // Keine Errors vorhanden
            if (empty($data['name_err']) && empty($data['lastname_err']) && empty($data['event_err']) && empty($data['company_err']))
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
    }
}
