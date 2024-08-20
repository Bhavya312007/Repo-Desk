<?php

function remove_junk($str){
    $str = nl2br($str);
    $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
    return $str;
  }
    function alert($message,$exit=False){ 
        echo "<script>alert('$message')</script>";
        if($exit==True) exit(0);
    }
    function size_check($var,$size,$message){
        if(strlen($var)>$size) alert($message,True);
    }
    function array_check($num ,$array){
        foreach($array as $element){
            if($element==$num) return true;
        }
        return false;
    }
    function insert_query1($table,$element){
        $sql =" insert into ".$table.' values (';
        for($i=0;$i<count($element);$i++){
            if($i!=0) $sql=$sql.",";
            else $sql=$sql."'".remove_junk($element[$i])."'";
        }
        $sql=$sql.');';
        return $sql;
    }
    
    function insert_query2($table,$element,$num,$dates=[]){
        //$table = table name
        //$element = array of elements
        // $num =array of number at which input are number
        //$dates = array of number at which input are date
        $sql =" insert into ".$table.' values (';
        for($i=0;$i<count($element);$i++){
            if($i!=0) $sql=$sql.",";//comma
            //number
            if(array_check($i+1,$num)){
                if($element[$i]=="") $sql=$sql."0";
                else $sql=$sql.$element[$i];
            }
            else if(array_check($i+1,$dates) && $element[$i]=="") $sql=$sql."null";//date
            else $sql=$sql."'".remove_junk($element[$i])."'";//string
        }
        $sql=$sql.');';
        return $sql;
    }
    function insert_query3($table,$names,$element,$num,$dates=[]){
        $sql =" insert into ".$table."(";
        //names
        for($i=0;$i<count($names);$i++){
            if($i!=0)$sql.= " , ";
            $sql.= $names[$i];
        }
        $sql.= ') values (';
        for($i=0;$i<count($element);$i++){
            if($i!=0) $sql=$sql.",";
            if(array_check($i+1,$num)){
                if($element[$i]=="") $sql=$sql."0";
                else $sql=$sql.$element[$i];
            }
            else if(array_check($i+1,$dates) && $element[$i]=="") $sql=$sql."null";
            else $sql=$sql."'".remove_junk($element[$i])."'";
        }
        $sql=$sql.');';
        return $sql;
    }
    function insert_query4($table,$names,$element,$dates=[]){
        $sql =" insert into ".$table."(";
        //names
        for($i=0;$i<count($names);$i++){
            if($i!=0)$sql.= " , ";
            $sql.= $names[$i];
        }
        $sql.= ') values (';
        for($i=0;$i<count($element);$i++){
            if($i!=0) $sql=$sql.",";
            if(array_check($i+1,$dates) && $element[$i]=="") $sql=$sql."null";
            else $sql=$sql."'".remove_junk($element[$i])."'";
        }
        $sql=$sql.');';
        return $sql;
    }

    function countQuery($table,$select,$where,$name,$num,$dates=[]){
        $sql =" select  count(".$select.") from ".$table;

        //where
        $sql=$sql."  where ";
        for($i=0;$i<count($where);$i++){
            if($i!=0) $sql=$sql." and ";
            if(array_check($i+1,$dates) && $where[$i]=="" ) $sql.= $name[$i]." is ";
            else $sql=$sql.$name[$i]." = ";

            if(array_check($i+1,$num)){
                if($where[$i]=="") $sql.="0";
                else $sql.=$where[$i];
            }
            else if(array_check($i+1,$dates) && $where[$i]=="") $sql=$sql."null";
            else $sql=$sql."'".remove_junk($where[$i])."'";
        }
        $sql=$sql.' ;';
        return $sql;
    }

    //only num
    function update_query($table,$element,$name1,$num1,$where,$name2,$num2){
        $sql="update ".$table;

        //set
        $sql=$sql." set ";
        for($i=0;$i<count($element);$i++){
            if($i!=0) $sql=$sql." , ";
            $sql=$sql.$name1[$i]." = ";
            if(array_check($i+1,$num1)){
                if($element[$i]=="") $sql.="0";
                else $sql.=$element[$i];
            }
            else $sql.="'".remove_junk($element[$i])."'";
        }

        //where
        $sql=$sql."  where ";
        for($i=0;$i<count($where);$i++){
            if($i!=0) $sql=$sql." and ";
            $sql=$sql.$name2[$i]." = ";
            if(array_check($i+1,$num2)){
                if($where[$i]=="") $sql.="0";
                else $sql.=$where[$i];
            }
            else $sql.="'".remove_junk($where[$i])."'";
        }
        $sql=$sql.' ;';
        return $sql;

    }

    //num and dates
    function update_query2($table,$element,$name1,$num1,$dates1,$where,$name2,$num2,$dates2){
        $sql="update ".$table;

        //set
        $sql=$sql." set ";
        for($i=0;$i<count($element);$i++){
            if($i!=0) $sql=$sql." , ";
            $sql=$sql.$name1[$i]." = ";
            if(array_check($i+1,$num1)){
                if($element[$i]=="") $sql.="0";
                else $sql.=$element[$i];
            }
            else if(array_check($i+1,$dates1) && $element[$i]=='') $sql=$sql."null";
            else $sql=$sql."'".remove_junk($element[$i])."'";
        }

        //where
        $sql=$sql."  where ";
        for($i=0;$i<count($where);$i++){
            if($i!=0) $sql=$sql." and ";
            $sql=$sql.$name2[$i]." = ";
            if(array_check($i+1,$num2)){
                if($where[$i]=="") $sql.="0";
                else $sql.=$where[$i];
            }
            else if(array_check($i+1,$dates2) && $where[$i]=="") $sql=$sql."null";
            else $sql=$sql."'".remove_junk($where[$i])."'";
        }
        $sql=$sql.' ;';
        return $sql;

    }
    function delete_query($table,$where,$name,$num){
        $sql="delete from ".$table;

        //where
        $sql=$sql."  where ";
        for($i=0;$i<count($where);$i++){
            if($i!=0) $sql=$sql." and ";
            $sql=$sql.$name[$i]." = ";
            if(array_check($i+1,$num)) $sql=$sql.$where[$i];
            else $sql=$sql."'".remove_junk($where[$i])."'";
        }
        $sql=$sql.' ;';
        return $sql;
    }
    function getLimit($type){
        $limit=$conn->query("select name from constants where type='$type';");
        if($limit->num_rows!=0) return $limit->fetch_assoc['name'];
        else if($type="limit") return 50;
        else if($type="uLimit") return 10;
        else echo "Error ::Invalid type.";
    }
    echo "<script src='../../assests/css/util.js'></script>";
?>