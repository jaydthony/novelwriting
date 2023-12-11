<?php 

include("functions.php");

$getnewvote=$_POST["vote"];

if(!empty($_POST["id"])) {
	$count=user_count_invote($_POST["id"],$logged_user->id,$db); 
	if($count==0){
$resultq=insert_vote($logged_user->id,$_POST["id"],$_POST["vote"],$db);
	} 
  else 
	{ 
	 $rows=fetch_invote($_POST["id"],$logged_user->id,$db);
	 foreach($rows as $rowm){
	$oldrank=$rowm['vote']; 
}
	 $_POST["vote"];
	if($oldrank==1 && $_POST["vote"]==-1)
	{
$resultq=update_vote($logged_user->id,$_POST["id"],'-1',$db); 
delete_vote($_POST["id"],$logged_user->id,$db);
	} 
	elseif($oldrank==0 && $_POST["vote"]==-1)
	{ 
$resultq=update_vote($logged_user->id,$_POST["id"],'-1',$db); 
	}
elseif($oldrank==-1 && $_POST["vote"]==1)
{
$resultq=update_vote($logged_user->id,$_POST["id"],'+1',$db); 
delete_vote($_POST["id"],$logged_user->id,$db);
	}
	elseif($oldrank==0 && $_POST["vote"]==1)
	{ 
$resultq=update_vote($logged_user->id,$_POST["id"],'+1',$db); 

	}
	else {}	
	} 
	     if(!empty($resultq)){
		switch($getnewvote) {
			case "1":
update_vote_inposts($_POST["id"],'+1',$db);
			break;
			case "-1":
			 update_vote_inposts($_POST["id"],'-1',$db);
			break;
		}	
		 }
$rows=fetch_netvote($_POST["id"],$db);
     foreach($rows as $rowl){
		$total_vote=$rowl['netvotes'];
	}
$rows=fetch_invote($_POST["id"],$logged_user->id,$db);
$rank=0;
	 foreach($rows as $rowm){
	$rank=$rowm['vote']; 
}
	$response = array(
        'netvotes' => $total_vote,
        'vote' => $rank
    );
echo json_encode($response);
}
?>