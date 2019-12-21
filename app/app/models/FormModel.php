<?php

class FormModel extends BaseModel
{

    public function writeData($data)

    
    //private $lastname = $data['lastname'];
    //private $datefrom = $data['datefrom'];
    {
        $email = $data['email'];
        $name = $data['name'];
        $lastname = $data['lastname'];
        $event = $data['event'];
        $company = $data['company'];
        $datefrom = $data['datefrom'];
        $dateto = $data['dateto'];


        $this->db->query("SELECT id FROM Forms ORDER BY id DESC LIMIT 1");
        $id2 = $this->db->single();
        $id = $id2[0]+1;
        $listingids = $id;

        //$this->writeListings($data, $id);

        //$total = ($data['price1']/100*$data['VAT1'])+$data['price1'];
        $total = 123;
        $status = 0;


        $this->db->query("INSERT INTO Forms (id, email, name, lastname, event, company, datefrom, dateto, listingids, total, status) VALUES (:id, :email, :name, :lastname, :event, :company, :datefrom, :dateto, :listingids, :total, :status)");
        $this->db->bind(':id', $id);
        $this->db->bind(':email', $email);
        $this->db->bind(':name', $name);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':event', $event);
        $this->db->bind(':company', $company);
        $this->db->bind(':datefrom', $datefrom);
        $this->db->bind(':dateto', $dateto);
        $this->db->bind(':listingids', $listingids);
        $this->db->bind(':total', $total);
        $this->db->bind(':status', $status);
        $this->db->execute(); 
    }

    public function acceptSet($id){
        $id = $id;
        $this->db->query("UPDATE Forms SET status = 1 WHERE id = '$id'");
        $this->db->execute();

    }

    public function getEntryTotal($id, $data){
        $id = $id;
        $data = $data;
        $this->db->query("SELECT * FROM Forms WHERE id = '$id'");
        $formEntry = $this->db->single();
        $total = 0;
        foreach($data as $entry) {
            $price = $entry['price'];
            $VAT = $entry['VAT'];
            $total = $total + (($price/100*$VAT)+$price);
        }
        echo $total;
    }

    public function getFormData($email)
    {  
        $this->db->query("SELECT * FROM Forms WHERE email = '$email'"); // 1. id = datenbank feld 2. platzhalter für variable
        $data = $this->db->resultSet();


        return $data;
    }

}
