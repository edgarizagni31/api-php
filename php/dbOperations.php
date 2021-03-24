<?php
require '../php/class/classDB.php';

function get($id = null)
{
    $db = DB::getInstance();
    if (is_null($id)) {
        $result = $db->query("SELECT * FROM cita");
    } else {
        $stm = $db->prepare("SELECT * FROM cita WHERE id  = :id");
        $stm->execute(array(
            ":id" => $id
        ));
        $result = $stm->fetch();
    }

    return $result;
}

function insert($array)
{
    if ($array != null) {
        $db = DB::getInstance();
        $stm = $db->prepare("INSERT INTO cita VALUES (null,:mascot,:owner,:phone,:date,:time,:symptom)");
        $result = $stm->execute(
            array(
                ":mascot" => $array["mascot"],
                ":owner" => $array["owner"],
                ":phone" => $array["phone"],
                ":date" => $array["date"],
                ":time" => $array["time"],
                ":symptom" => $array["symptom"]
            )
        );
    }

    return $result;
}


function update($array, $id)
{
    if ($array != null) {
        $db = DB::getInstance();
        $stm = $db->prepare("UPDATE cita SET mascot = :mascot, owner = :owner, phone = :phone, date = :date, time = :time, symptom = :symptom WHERE id = :id");
        $result = $stm->execute(
            array(
                ":mascot" => $array["mascot"],
                ":owner" => $array["owner"],
                ":phone" => $array["phone"],
                ":date" => $array["date"],
                ":time" => $array["time"],
                ":symptom" => $array["symptom"],
                ":id" => $id
            )
        );
    }

    return $result;
}

function delete($id)
{
    $db = DB::getInstance();

    $stm = $db->prepare("DELETE FROM cita WHERE  id = :id");

    $result = $stm->execute(array(
        ":id" => $id
    ));

    return $result;
}
