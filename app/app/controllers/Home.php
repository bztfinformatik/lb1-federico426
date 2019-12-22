<?php

class Home extends Controller
{
    public function index($name = '')
    {


    	echo "<br><br><br><br><br><br><br><br><br>";
var_dump($_SESSION);
    	if (isset($_SESSION)) {
    		$uservariables = $_SESSION;
    		echo $this->twig->render('home/index.twig.html', ['title' => "Home / Index", 'urlroot' => URLROOT, 'uservariables' => $uservariables]); 
    	}else
        echo $this->twig->render('home/index.twig.html', ['title' => "Home / Index", 'urlroot' => URLROOT] );                
        //echo $this->twig->render('base/layout.twig.html', ['title' => "Titel Page"] );
    }
}