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


        $this->db->query("SELECT id FROM Forms ORDER BY id DESC LIMIT 1");
        $id2 = $this->db->single();
        $id = $id2[0]+1;
        $listingids = $id;

        $this->writeListings($data, $id);

        $total = ($data['price1']/100*$data['VAT1'])+$data['price1'];
        $status = 0;

        //var_dump($data);
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

    public function writeListings($data, $idin){
        $formid = $idin;
        $id = 0;

        var_dump($data);

        $formdate = $data['dateform1'];
        $description = $data['product1'];
        $price = $data['price1'];
        $VAT = $data['VAT1'];
        $account = 100;



        $this->db->query("INSERT INTO Listings (id, formid, formdate, description, price, VAT, account) VALUES (:id, :formid, :formdate, :description, :price, :VAT, :account)");

        $this->db->bind(':id', $id);
        $this->db->bind(':formid', $formid);
        $this->db->bind(':formdate', $formdate);
        $this->db->bind(':description', $description);
        $this->db->bind(':price', $price);
        $this->db->bind(':VAT', $VAT);
        $this->db->bind(':account', $account);

        $this->db->execute();





    }

    public function acceptSet($id){
        $id = $id;
        $this->db->query("UPDATE Forms SET status = 1 WHERE id = '$id'");
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
