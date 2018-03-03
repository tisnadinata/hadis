<?php
    include "../config/config_db.php";

    if(isset($_POST['pilihriwayat'])){
        $riwayat = $_POST['pilihriwayat'];
        $sql = 'select * from hadis_riwayat where LOWER(riwayat_nama) LIKE "'.strtolower($riwayat).'"';
        $get_hadis_riwayat = $mysqli->query($sql);
        $get_riwayat = $get_hadis_riwayat->fetch_object();
        $get_hadis_kitab = $mysqli->query("select * from hadis_kitab where kitab_id = ".$get_riwayat->riwayat_id."")->fetch_object();
        while($get_kitab = $get_hadis_kitab->fetch_object()){
            echo "<option value='".$get_kitab->kitab_nama."'>".strtoupper($get_kitab->kitab_nama)."</option>";
        }
    }
?>