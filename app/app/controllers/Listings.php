<?php

class Listings extends Controller
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
        $listingModel = $this->model('ListingsModel');
        $formModel = $this->model('FormModel');
        $forms = $formModel->getFormData();

        echo "<br><br><br><br><br><br>";
        var_dump($_SESSION);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //var_dump($_POST);

            $event1 = trim(
                filter_input(INPUT_POST, 'event1', FILTER_SANITIZE_STRING)
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
            $account1 = trim(
                filter_input(INPUT_POST, 'account1', FILTER_SANITIZE_STRING)
            );




            // Daten setzen
            $data = [
                'event1' => $event1,
                'event1_err' => '',
                'dateform1' => $dateform1,
                'dateform1_err' => '',
                'product1' => $product1,
                'product1_err' => '',
                'price1' => $price1,
                'price1_err' => '',
                'VAT1' => $VAT1,
                'VAT1_err' => '',
                'account1' => $account1,
                'account1_err' => ''

            ];




            // Keine Errors vorhanden
            if (empty($data['dateform1_err']) && empty($data['product1_err']) && empty($data['price1_err']) && empty($data['VAT1_err']) )
            {
                // Alles gut, keine Fehler vorhanden
                // Späteres TODO: Auf DB schreiben
                //die('SUCCESS');
                $listingModel->writeListings($data);
            }
            else {
                // Fehler vorhanden - Fehler anzeigen
                // View laden mit Fehlern

                echo $this->twig->render('lisitng/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data, 'forms' => $forms]);
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

            echo $this->twig->render('listing/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data, 'forms' => $forms]);
        }
        header("Location: http://localhost:8000/public/Formadmin/");
    }

}
