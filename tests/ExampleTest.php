<?php

use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    private $headers = ['Authorization' =>"Bearer avaliacao369"];

    public function testExample()
    {
        $this->isOnline();
        $this->userCount();
        $this->movementCount();
        $this->movementRecords();

    }

    private function isOnline(){
        $this->get('/');

        //Aplicação online
        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    private function userCount(){
        $response = $this->get('/users',$this->headers)->seeStatusCode(200)->response->getContent();

        $response = json_decode($response, true);        
        $this->assertTrue(json_last_error() == 0, "Erro JSON mal formatado /users");

        //verifico a consistencia da saida da api
        $this->assertTrue(count($response) == DB::select("SELECT COUNT(*) as total FROM user")[0]->total, 'Consistencia de usuarios');
    }

    private function movementCount(){
        $response = $this->get('/users',$this->headers)->seeStatusCode(200)->response->getContent();

        $response = json_decode($response, true);        
        $this->assertTrue(json_last_error() == 0, "Erro JSON mal formatado /users");

        //verifico a consistencia da saida da api
        $this->assertTrue(count($response) == DB::select("SELECT COUNT(*) as total FROM movement")[0]->total, 'Consistencia de movimentos');
    }

    private function movementRecords(){
        $response = $this->get('/movements_records/1',$this->headers)->seeStatusCode(200)->response->getContent();

        $response = json_decode($response, true);        
        $this->assertTrue(json_last_error() == 0, "Erro JSON mal formatado /users");

        for ($i=0; $i < count($response); $i++) {             
            if($i > 0){                
                $this->assertTrue($response[$i-1]['position'] <= $response[$i]['position'], 'Position divergente');
                $this->assertTrue($response[$i-1]['value'] >= $response[$i]['value'], 'Value divergente');
            }
        }
    }
}
