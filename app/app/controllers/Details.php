<?php

class Details extends Controller
{

    private $user;

    public function index($name = '')
    {   
        if (isset($_SESSION['user_id'])) {
            $uservariables = $_SESSION;
            echo $this->twig->render('detailpage/index.twig.html', ['title' => "Spesen - Detail / Index", 'urlroot' => URLROOT, 'uservariables' => $uservariables]);
        }else{
            redirect('Users/Login');
        }
    }

    public function show(){
        if (isset($_SESSION['user_id'])) {
            $uservariables = $_SESSION;
            $formModel = $this->model('FormModel');
            $listingModel = $this->model('ListingsModel');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'];
                $listings = $listingModel->getEntries($id);
                $singleForm = $formModel->getFormByID($id);
                $total = $listingModel->getEntryTotal($listingModel->getEntries($id));
                $singleForm['allCosts'] = $total;

                echo $this->twig->render('detailpage/index.twig.html', ['title' => "Detailpage", 'urlroot' => URLROOT, 'singleForm' => $singleForm, 'listings' => $listings, 'uservariables' => $uservariables]);
            }else {
                echo "No Post";
            }
            header("Location: http://localhost:8000/public/Details/");
        }else{
            redirect('Users/Login');
        }
    }
}
