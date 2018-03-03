<?php
include "../config/config_db.php";

function hello(){
    $riwayat_id = "integer";
    $riwayat_nama = "string";
    $last_edited = "timestamp";
    $list_riwayat[0] = array(
        "riwayat_id"=>$riwayat_id,
        "riwayat_nama"=>$riwayat_nama,
        "last_edited"=>$last_edited
    );
    Flight::json(array(
        "code"=>0,
        "message"=>"succes | fail",
        "data"=>$list_riwayat
    ));
}

function getRiwayat() {
    // validasi
        $missingParameters = array();
        if (Flight::request()->data->id != "") {
            array_push($missingParameters, 'id');
        }
        reportMissingParameters($missingParameters);
    // logic
        $riwayat_id = "integer";
        $riwayat_nama = "string";
        $last_edited = "timestamp";
        $list_riwayat[0] = array();
        if(Flight::request()->data->id == '0'){
            $get_hadis_riwayat = $mysqli->query("select * from hadis_riwayat order by riwayat_nama");
            $id=0;
            while($get_riwayat = $get_hadis_riwayat->fetch_object()){
                $list_riwayat[$id] = array(
                    "riwayat_id"=>$get_riwayat->riwayat_id,
                    "riwayat_nama"=>$get_riwayat->riwayat_nama,
                    "last_edited"=>$get_riwayat->last_edited
                );
            }
        }else{
            $get_riwayat = getDataByCollumn("hadis_riwayat","riwayat_id",Flight::request()->data->id)->fetch_object();
            $list_riwayat[0] = array(
                "riwayat_id"=>$get_riwayat->riwayat_id,
                "riwayat_nama"=>$get_riwayat->riwayat_nama,
                "last_edited"=>$get_riwayat->last_edited
            );
        }
    // response
        Flight::json(array(
            "code"=>0,
            "message"=>"success",
            "data"=>$list_riwayat
        ));
    }
function addRiwayat() {
// validasi
    $missingParameters = array();
    if (Flight::request()->data->nama != "") {
        array_push($missingParameters, 'nama');
    }
    reportMissingParameters($missingParameters);
// logic
    $message = "fail";
    $riwayat_id = "integer";
    $riwayat_nama = "string";
    $last_edited = "timestamp";
    $list_riwayat[0] = array();
    $add_hadis_riwayat = $mysqli->query('insert into hadis_riwayat(riwayat_name) values("'.Flight::request()->data->nama.'")');
    if($add_hadis_riwayat){
        $message = "success";
        $get_riwayat = getDataByCollumn("hadis_riwayat","riwayat_nama",Flight::request()->data->nama)->fetch_object();
        $list_riwayat[0] = array(
            "riwayat_id"=>$get_riwayat->riwayat_id,
            "riwayat_nama"=>$get_riwayat->riwayat_nama,
            "last_edited"=>$get_riwayat->last_edited
        );
    }else{
        $message = "fail";
    }
// response
    Flight::json(array(
        "code"=>0,
        "message"=>$message,
        "data"=>$list_riwayat
    ));
}
 
function reportMissingParameters($missingParameters) {
    $parameters = implode(", ", $missingParameters);
    Flight::json(array(
        "code"=>1,
        "message"=>"Missing parameter: ".$parameters.".",
        "data"=>null
    ));
    exit();
}
 
?>