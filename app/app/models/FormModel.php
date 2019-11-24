<?php

class FormModel extends BaseModel
{

    public function fakewriteData($data)

    
    //private $lastname = $data['lastname'];
    //private $datefrom = $data['datefrom'];
    {
        $name = $data['name'];
        $lastname = $data['lastname'];
        $datefrom = $data['datefrom'];
        $dateto = $data['dateto'];


        
        $id = 12;
        $listingids = 12;
        $total = 12.5;
        $status = 1;

        var_dump($data);
       // die(var_dump($data));

        $this->db->query("INSERT INTO Forms (id, name, lastname, datefrom, dateto, listingids, total, status) VALUES (:id, :name, :lastname, :datefrom, :dateto, :listingids, :total, :status)");
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $name);
        $this->db->bind(':lastname', $lastname);
        $this->db->bind(':datefrom', $datefrom);
        $this->db->bind(':dateto', $dateto);
        $this->db->bind(':listingids', $listingids);
        $this->db->bind(':total', $total);
        $this->db->bind(':status', $status);
        
        $this->db->execute();
        
    }

    public function getFakeFormData()
    {

        $id = 1;

        /*$this->db->query("SELECT * FROM Forms WHERE id = :id"); // 1. id = datenbank feld 2. platzhalter für variable
        $this->db->bind(":id", $id);
        $data = $this->db->resultSet();*/

        $this->db->query("SELECT * FROM Forms"); // 1. id = datenbank feld 2. platzhalter für variable

        $data = $this->db->resultSet();

        return $data;
    }

}
