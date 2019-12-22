<?php

class Listings extends Controller
{

    private $user;

    public function index($name = '')
    {
        if (isset($_SESSION['user_id'])) {
            $uservariables = $_SESSION;
            echo $this->twig->render('form/index.twig.html', ['title' => "Neue Position", 'urlroot' => URLROOT, 'uservariables' => $uservariables]);
        }else{
            redirect('Users/Login');
        }
    }

    public function add()
    { 
        if (isset($_SESSION['user_id'])) {
            $uservariables = $_SESSION;
            $listingModel = $this->model('ListingsModel');
            $formModel = $this->model('FormModel');
            $forms = $formModel->getFormData($_SESSION);
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
                    echo $this->twig->render('lisitng/add.twig.html', ['title' => "Neue Position", 'urlroot' => URLROOT, 'data' => $data, 'forms' => $forms, 'uservariables' => $uservariables]);
                }
            }else{
                echo $this->twig->render('listing/add.twig.html', ['title' => "Neue Position", 'urlroot' => URLROOT, 'data' => $data, 'forms' => $forms, 'uservariables' => $uservariables]);
            }
            header("Location: http://localhost:8000/public/Formadmin/");
        }else{
            redirect('Users/Login');
        }
    }

}
