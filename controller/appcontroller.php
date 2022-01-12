<?php
namespace App\Controller;

use App\model\nova;
use App\helper\viewhelper;
use App\helper\dbhelper;


class appcontroller
{
    var $db;
    var $view;

    function __construct()
    {
        //Conexión a la BBDD
        $dbhelper = new dbhelper();
        $this->db = $dbhelper->db;

        //Instancio el ViewHelper
        $viewhelper = new viewhelper();
        $this->view = $viewhelper;
    }

    public function index(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM novas WHERE activo=1 AND home=1 ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $novas = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($nova,new Nova($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "index", $novas);
    }

    public function acercade(){

        //Llamo a la vista
        $this->view->vista("app", "acercade");

    }
    public function contacto () {
         //llamo a la vista
         $this->view->vista ("app","contacto");
}
    public function novas(){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM novas WHERE activo=1 ORDER BY fecha DESC");

        //Asigno resultados a un array de instancias del modelo
        $novas = array();
        while ($row = $rowset->fetch(\PDO::FETCH_OBJ)){
            array_push($novas,new nova($row));
        }

        //Llamo a la vista
        $this->view->vista("app", "novas", $novas);

    }

    public function nova($slug){

        //Consulta a la bbdd
        $rowset = $this->db->query("SELECT * FROM novas WHERE activo=1 AND slug='$slug' LIMIT 1");

        //Asigno resultado a una instancia del modelo
        $row = $rowset->fetch(\PDO::FETCH_OBJ);
        $nova = new nova($row);

        //Llamo a la vista
        $this->view->vista("app", "nova", $nova);

    }
}