<?php

class ListingsModel extends BaseModel
{


    public function getListingsDataArray()
    {
        $data = [
            ['id' => '1', 'formid' => '1', 'date' => '01/06/1998', 'description' => 'Zugticket nach Paris', 'price' => '30.20', 'VAT' => '7.5', 'account' => '100']
        ];

        return $data;
    }

    public function writeListings($data){

    	var_dump($data);

    	$this->db->query("SELECT id FROM Listings ORDER BY id DESC LIMIT 1");
        $id2 = $this->db->single();
        $id = $id2[0]+1;

        $formid = $data['event1'];
        $formdate = $data['dateform1'];
        $description = $data['product1'];
        $price = $data['price1'];
        $VAT = $data['VAT1'];
        $account = $data['account1'];

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


    public function getEntries($id){
        $id = $id;
        $this->db->query("SELECT * FROM Listings WHERE formid = '$id'");
        $listingEntries = $this->db->resultSet();
        return $listingEntries;
    }

}