<?php

class FormModel extends BaseModel
{
/*  private $id;
    private $userid;
    private $name;
    private $email;
    private $comment;
    private $adminmodified;
    private $refmenue;
    private $status;
    private $dateorder;
    private $wishtime;
 */

    public function fakewriteData($data)
    {
        die(var_dump($data));
        
    }

    public function getFakeFormData()
    {
        $data = [
            ['id' => '1', 'name' => 'Federico', 'lastname' => 'Degan','datefrom' => '01/01/2019' ,'dateto' => '31/12/2019','listingids' => '1', 'total' => '30.20','status' => true],
            ['id' => '2', 'name' => 'Federico Deux', 'lastname' => 'Deuxan','datefrom' => '01/01/2019' ,'dateto' => '31/12/2019','listingids' => '2', 'total' => '60.20','status' => false]
        ];

        return $data;
    }

}
