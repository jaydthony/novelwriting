<?php

$table_name = "users";

$api_url =  DOMAIN_PATH."user.php";

$db_columns = "full_name, username,  hashed_password, rank,  status";


 

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $api_url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_POST, 0);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 

  // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

  //Executing the Request

  $output = curl_exec($ch);

  // print $output;

  if (!$output) {
    print "Error ".curl_error($ch);
  }

  //Closing and free up the handle..


  $json = json_decode($output,true);

  $last_live_id = $json['last_id'];


  $sql_id = "SELECT id FROM ".$table_name." where id > '".$db->escape_string($last_live_id)."' "; 

  // print $sql_id;

  $result_id = $db->query($sql_id);    

  $row_id = $result_id->fetch_assoc();

  $user_data = [

    'username' => 'lexispos',

    'password' => '12',

    'location' => 'lexispos'
  ];


  if ($row_id['id'] > $last_live_id) {  


  $sql_check = "SELECT ".$db_columns." FROM ".$table_name." where id > '".$db->escape_string($last_live_id)."' "; 

  // print $sql_check;

  $result_check = $db->query($sql_check);    



    $user_array = [];

    while ( $row_check  = $result_check->fetch_assoc()) {
      
      $user_array[] = $row_check;

    }

$data = [];


foreach ($user_array as $innerArray) {
    //  Check type
    if (is_array($innerArray)){


          $sql = "INSERT INTO ".$table_name." ( ".$db_columns." )";

          $sql .= "VALUES( ";

          $sql .= "'".Mike::e($innerArray['full_name'])."', ";

          $sql .= "'".Mike::e($innerArray['username'])."', ";

          $sql .= "'".Mike::e($innerArray['hashed_password'])."', ";

          $sql .= "'".Mike::e($innerArray['rank'])."', ";

          $sql .= "'".Mike::e($innerArray['status'])."' ";

          $sql .=  " ); ";

          // $db->query($sql);


            $data[] = $sql;

          // print $sql ."<br>";
    }
}    


$send_data = [


'data' => implode(' ', $data)

];


  $ch_2 = curl_init();

  curl_setopt($ch_2, CURLOPT_URL, $api_url);

  curl_setopt($ch_2, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch_2, CURLOPT_POST, 1);

  curl_setopt($ch_2, CURLOPT_POSTFIELDS, $send_data);

  //Executing the Request


  $output_2 = curl_exec($ch_2);

  print ($output_2);

$total_insert = count($data);  

$filepath = $output_path;
$i = file_get_contents($filepath);
$i .= "<p> ".$total_insert." records inserted on ".$table_name." Table on ".date("F j, Y, g:i a")." <br> </p>";
file_put_contents($filepath, $i);

}else{


$filepath = $output_path;
$i = file_get_contents($filepath);
$i .= "<p>No new record found on ".$table_name." Table on ".date("F j, Y, g:i a")." <br> </p>";
file_put_contents($filepath, $i);


}

