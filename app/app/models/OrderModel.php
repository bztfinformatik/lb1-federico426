<?php

class OrderModel extends BaseModel
{
/*  private $id;
    private $userid;
    private $username;
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

    public function getFakeOrderData()
    {
        $data = [
            ['id' => '2', 'userid' => '', 'username' => 'TestBenutzer1','email' => 'test1@test.ch','comment' => 'TestKommentar1','refmenue' => '1','status' => 'Bestellt','dateorder' => ''],
            ['id' => '3', 'userid' => '', 'username' => 'TestBenutzer2','email' => 'test2@test.ch','comment' => 'TestKommentar2','refmenue' => '2','status' => 'Bereit','dateorder' => ''],
            ['id' => '4', 'userid' => '', 'username' => 'TestBenutzer3','email' => 'test3@test.ch','comment' => 'TestKommentar3','refmenue' => '1','status' => 'Abgeholt','dateorder' => ''],
            ['id' => '5', 'userid' => '', 'username' => 'TestBenutzer4','email' => 'test4@test.ch','comment' => 'TestKommentar4','refmenue' => '3','status' => 'Bestellt','dateorder' => '']
        ];

        return $data;
    }

    public function getFakeOrderDateForUserID($userid)
    {
        $data = [
            ['id' => '2', 'userid' => '1','username' => 'TestBenutzer1','email' => 'test1@test.ch','comment' => 'TestKommentar1','refmenue' => '1','status' => 'Bestellt','dateorder' => '']
        ];

        return $data;
    }

}
