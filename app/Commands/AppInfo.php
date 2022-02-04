<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class AppInfo extends BaseCommand
{
    protected $group       = 'demo';
    protected $name        = 'app:info';
    protected $description = 'Displays basic application information.';
    protected $logger;
    protected $table = ['`cdi_contract`'];
    protected $phone = ['0743783247', '0743713425', '0743113527', '0743117529', '0743111529', '0742111529'];     
  
    public function __construct($logger){
        $this->logger = $logger;
        $this->setConnection();
    }
    public function run(array $params)
    { 
        foreach($params as $key => $value)
        {
            $this->{$value}();
        }
    }
    public function setConnection()
    {
        $config      = config('Database');
        $this->group = $config->defaultGroup;
        unset($config);
        $this->db = db_connect( $this->group);         
    }
    public function fetch()
    {
        $query = $this->db->query('SELECT * FROM ' . $this->table[0]);

        foreach($query->getResult() as $k => $v)
        {
            $tel = '';
            foreach(unserialize($v->tel) as $key => $value)
            {
              $tel .= $value.',';   
            }
            $v->tel = $tel;             
            $_string =  '| ' . $v->id      . ' | ' . 
                               $v->nume    . ' | ' . 
                               $v->sex     . ' | ' . 
                               $v->cnp     . ' | ' . 
                               $v->email   . ' | ' .                                
                               $v->tel     . ' | ' .                                
                               $v->data    . ' | ' .
                               $v->created_at . ' | ' .
                               $v->updated_at . ' | ' .
                               $v->deleted    . ' | ';


            $_line = '';
            for($i = 0; $i < strlen($_string) -1; $i++ )
            {
                $_line .= '-';
            }
            echo $_line   . PHP_EOL;
            echo $_string . PHP_EOL;
            echo $_line   . PHP_EOL;
        }
    }
    public function delete()
    {
        $result = $this->db->table($this->table[0])->emptyTable();
        echo $result . PHP_EOL;
    }
    public function insert()
    {
        foreach($this->getData() as $k => $v)
        {
           $result = $this->db->table($this->table[0])->insert($v);
           echo $result . PHP_EOL;
        }
    }

    public function getData(){
        return array(
            array(
                'nume'  => "Nicula Gabriel",
                'sex'   => "M",
                'cnp'   => "1870126113925",
                'email' => "nicula.gabriel87@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '26/03/1987'
            ),
            array(
                'nume'  => "Avram Alin",
                'sex'   => "M",
                'cnp'   => "1870126313427",
                'email' => "avram.alin83@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '12/06/1983'
            ),
            array(
                'nume'  => "Sandu Alina",
                'sex'   => "F",
                'cnp'   => "1871024313221",
                'email' => "sandu.alin81@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '01/02/1981'
            ),
            array(
                'nume'  => "Bungiu Gigi",
                'sex'   => "M",
                'cnp'   => "1871023333225",
                'email' => "bungiu.gigi90@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '24/07/1990'
            ),
            array(
                'nume'  => "Postolache Anca",
                'sex'   => "F",
                'cnp'   => "1871028331645",
                'email' => "postolache.anca95@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '01/01/1995'
            ),
            array(
                'nume'  => "Mitran Alina",
                'sex'   => "F",
                'cnp'   => "1871021342641",
                'email' => "mitran.alina88@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '01/06/1988'
            ),
            array(
                'nume'  => "Dima Mihai",
                'sex'   => "M",
                'cnp'   => "187103246646",
                'email' => "dima.mihai89@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '03/06/1989'
            ),
            array(
                'nume'  => "Fotache Irina",
                'sex'   => "M",
                'cnp'   => "187113276849",
                'email' => "fotache.irina78@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '03/06/1978'
            ),
            array(
                'nume'  => "Tristariu Alin",
                'sex'   => "M",
                'cnp'   => "187223295844",
                'email' => "tristariu.alin79@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '03/06/1979'
            ),
            array(
                'nume'  => "Crina Balan",
                'sex'   => "F",
                'cnp'   => "187223299945",
                'email' => "crina.balan82@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '08/18/1982'
            ),
            array(
                'nume'  => "Roman Razvan",
                'sex'   => "M",
                'cnp'   => "187123219915",
                'email' => "roman.razvan95@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '08/18/1995'
            ),
            array(
                'nume'  => "Andronache Dan",
                'sex'   => "M",
                'cnp'   => "187127719125",
                'email' => "andronache.dan97@yahoo.com",
                'tel'   => serialize($this->phone),
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'deleted'    => 0,
                'data'       => '08/18/1997'
            ),
        );
         
    }
}