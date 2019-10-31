<?php

class MenueModel extends BaseModel
{
    /* private $id;
    private $title;
    private $preis;
    private $description;
    private $active
    */

    public function getFakeMenueDataArray()
    {
        $data = [
            ['id' => '1', 'title' => 'Spaghetti', 'preis' => '15', 'description' => 'Spaghetti Bolo', 'active' => true],
            ['id' => '2', 'title' => 'Spaghetti', 'preis' => '15', 'description' => 'Spaghetti Carbonara', 'active' => true],
            ['id' => '3', 'title' => 'Pizza', 'preis' => '15', 'description' => 'Napoli', 'active' => true]
        ];

        return $data;
    }

}