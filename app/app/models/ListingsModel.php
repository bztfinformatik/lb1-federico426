<?php

class ListingsModel extends BaseModel
{


    public function getFakeListingsDataArray()
    {
        $data = [
            ['id' => '1', 'formid' => '1', 'date' => '01/06/1998', 'description' => 'Zugticket nach Paris', 'price' => '30.20', 'VAT' => '7.5%', 'account' => '100']
        ];

        return $data;
    }

}