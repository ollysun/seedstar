<?php
/**
 * Created by PhpStorm.
 * User: Moses
 * Date: 08/12/2016
 * Time: 23:28
 */

//LINK OF JENKINS API
$link = 'https://builds.apache.org/api/json?tree=jobs[displayName,lastBuild[result]]';
try {
//GET RESPONSE OF JENKINS API
    $jobsString = file_get_contents($link);
//CONVERT STRING TO JSON
    $jobs = json_decode($jobsString);
//NEW CONNECTION TO DATABASE
    $db = new PDO('sqlite:Jenkins.db');
    // create table
    $db->exec('
            CREATE TABLE IF NOT EXISTS jobs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL ,
            status TEXT,
            time_checked TIMESTAMP DEFAULT current_timestamp
            )');
//QUERIE
    $query = 'INSERT INTO jobs (name, status, time_checked) VALUES (:name, :status, :timechecked)';
//INSERT JOBS IN DATABASE
    if (sizeof($jobs->jobs) > 0) {

        foreach ($jobs->jobs as $key => $value) {
            $sql = $db->prepare($query);
            //var_dump($sql);die();
            $sql->bindParam(':name', $value->displayName, PDO::PARAM_STR);
            $sql->bindParam(':status', $value->lastBuild->result, PDO::PARAM_STR);
            $sql->bindParam(':timechecked', date("Y-m-d H:i:s"));
            $sql->execute();

            $errors = $sql->errorInfo();
//IF AN ERROR OCCUR DISPLAY THE ERROR
            if ($errors[0] !== "00000") {
                echo "For Job " . $value->displayName . " ERROR:" . $errors[2];
            }
        }

        echo "DONE!!!!";
    } else {
        echo "There isn't any job to insert";
    }
} catch (Exception $e) {
    echo "Error:" . $e->getMessage();
}