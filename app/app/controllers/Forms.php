<?php

class Forms extends Controller
{

    private $user;

    public function index($name = '')
    {
        if (isset($_SESSION['user_id'])) {
            $uservariables = $_SESSION;
        echo $this->twig->render('form/index.twig.html', ['title' => "Spesen - Placement / Index", 'urlroot' => URLROOT, 'uservariables' => $uservariables]);
        }else{
            redirect('Users/Login');
        }
    }
    public function add()
    {
        if (isset($_SESSION['user_id'])) {
            $uservariables = $_SESSION;
        $formModel = $this->model('FormModel');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            $data = [
                'email' => $email,
                'name' => $name,     
                'name_err' => '',
                'lastname' => $lastname,  
                'lastname_err' => '',
                'datefrom' => $datefrom,
                'datefrom_err' => '',
                'dateto' => $dateto,
                'dateto_err' => '',
                'event' => $event,  
                'event_err' => '',
                'company' => $company,
                'company_err' => '',
                'zip' => $zip,      
                'zip_err' => '',
                'location' => $location,      
                'location_err' => ''
            ];

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
            if (empty($data['name_err']) && empty($data['lastname_err']) && empty($data['event_err']) && empty($data['company_err']) )
            {
                echo "wir sind hier <br>";
                $formModel->writeData($data);
            }
            else {
                echo $this->twig->render('form/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data]);
            }

        } else {
            $data = [
                'name' => '',      
                'name_err' => '',
                'lastname' => '',       
                'lastname_err' => '',
                'datefrom' => '',
                'dateto' => '',
                'event' => '',       
                'event_err' => '',
                'company' => '',       
                'company_err' => '',
                'zip' => '',      
                'zip_err' => '',
                'location' => '',       
                'location_err' => ''      
            ];
            echo $this->twig->render('form/add.twig.html', ['title' => "Order - Add", 'urlroot' => URLROOT, 'data' => $data, 'uservariables' => $uservariables]);
        }
        header("Location: http://localhost:8000/public/Formadmin/");
        }else{
            redirect('Users/Login');
        }
    }

    public function change(){
        if (isset($_SESSION['user_id'])) {
            $formModel = $this->model('FormModel');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'];
                $formModel->acceptSet($id);
            }else {
                echo "No Post";
            }
        header("Location: http://localhost:8000/public/Formadmin/");
        }else{
            redirect('Users/Login');
        }
    }
}
