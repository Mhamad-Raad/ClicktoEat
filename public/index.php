<?php
//hello darkness my old friend


use Pimple\Psr11\Container;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require '../vendor/autoload.php';
require_once 'db.php';

$app = new \Slim\App();







$app->get('/meals',function($request , $response,$args){

        $sql = "SELECT * FROM items";
        try {
            $db = new Db();
            $db = $db->connect();

            $stmt = $db->prepare($sql);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $db = null;

            echo json_encode($data);
        } catch (PDOException $e) {
            $data = array(
                "status" => "fail"
            );
            echo json_encode($data);
        }

});







$app->delete('/meals/remove/{item_name}',function($request , $response,$args){
$name= $args['item_name'];
try{


    $query= "DELETE from items where item_name='$name'";


    $db = new Db();
    $db = $db->connect();


    $stmt=$db->prepare($query);
    $stmt->execute();


    $db=null;


    $data=array(
        "status" => "removed"
    );



    echo json_encode($data);
}


catch(PDOException $e){
    $data=array(
        "status" => "failed"
    );



    echo json_encode($data);
}
});




$app->run();