<?php 

require_once './private/initialize.php';

 function user_count_invote($postid,$userid,$db){
        $sql= "SELECT count(*) from uservotes WHERE user_id = '".Whiz::e($userid)."' AND paragraph_id = '".Whiz::e($postid)."' "; 
        $result = $db->query($sql);
        $number_of_rows = $result->fetch_column();
        return $number_of_rows;
      }
     function insert_vote($userid,$postid,$vote,$db){
        $sql="INSERT INTO uservotes(user_id,paragraph_id,vote) VALUES($userid,$postid,$vote)";
        $result = $db->query($sql); 
        if($result)
            { 
        return  true; 
            }
      }
      function fetch_invote($postid,$userid,$db){
        $sql= "SELECT * from uservotes WHERE user_id = '".Whiz::e($userid)."' AND paragraph_id = '".Whiz::e($postid)."' "; 
        $result = $db->query($sql);    
        return $result; 
      }
       function update_vote($userid,$postid,$vote_type,$db){
         $sql="UPDATE uservotes SET vote= vote$vote_type WHERE user_id = '".Whiz::e($userid)."' AND paragraph_id = '".Whiz::e($postid)."' "; 
        $result = $db->query($sql);
         if($result){ 
        return true; 
         } 
      }
       function update_vote_inposts($postid,$vote_type,$db){
         $sql="UPDATE paragraphs SET netvotes= netvotes$vote_type WHERE id = '".Whiz::e($postid)."' "; 
        $result = $db->query($sql);
      }
      function fetch_netvote($postid,$db){
        $sql= "SELECT netvotes from paragraphs WHERE id = '".Whiz::e($postid)."' "; 
        $result = $db->query($sql);    
        return $result; 
      }
      function delete_vote($postid,$userid,$db){
        $sql= "DELETE from uservotes WHERE user_id = '".Whiz::e($userid)."' AND paragraph_id = '".Whiz::e($postid)."' "; 
        $result = $db->query($sql);
      }
