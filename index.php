<?php
$settings = null;
$envVars = null;
$results = null;

include('./settings/Settings.php');
include('./settings/Database.php');
include('./DB.php');
include ('./getVars.php');

$db = new DB($database[$settings['env']]);

if ( $envVars['function'] = 'login' ) {

    if (!isset($envVars['username']) || !isset($envVars['password']) ) {
        $results = 'Not enough arguments..';
    }
    else {
        $u = $envVars['username'];
        $p = $envVars['password'];
        $db->Query("SELECT 
	* 
FROM 
	users as u
LEFT JOIN
    profiles as p
ON 
	u.profile_id = p.id
LEFT JOIN
    roles as r
ON
	u.role_id = r.id
WHERE 
	TRIM(login) = '$u' AND
    TRIM(password) = '$p'");
        $results = $db->results;
    }
}

echo json_encode($results);
