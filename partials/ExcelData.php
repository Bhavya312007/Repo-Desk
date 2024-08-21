<?php
    require_once("Classes/PHPExcel.php");
    // require_once("util.php");

    function next_column($str){
        for($i=strlen($str)-1;$i>=0;$i--){
            if($str[$i]=='Z' && $i!=0) $str[$i]='A';
            else if($str[$i]=='Z' && $i==0){
                $str[$i]='A';
                $str='A'.$str;
            }
            else{
                $ascii=ord($str[$i]);
                $ascii++;
                $str[$i]=chr($ascii);
                break;
            }
        }
        return $str;
    }

    function power($num,$power){
        if($power==0) return 1;
        else if($power==1) return $num;
        else return $num*power($num,$power-1);
    }

    function excel_num_to_column($num){        
        if($num>0){
            $char_diff=($num-1)%26 +1;
            $char=chr(ord('A')-1+$char_diff);
            
            $num=($num-$char_diff)/26;
            return $char.excel_num_to_column($num);
        }
        else return "";
    }
    
    function getData($file){
        //reader object
        $reader = PHPExcel_IOFactory::createReaderForFile($file);
        $excel_obj = $reader->load($file);
    
        //getting sheet
        $worksheet=$excel_obj->getActiveSheet('0');

        $data=[];
        $row_number=1;
        $max_column=100;//maximum number of columns in the excel file 

        //finding number of useful columns in the excel file head
        $column_name='A';
        $column_traversal=0;
        for($i=0;;$i++){
            $cell=$column_name.$row_number;    
            $str=$worksheet->getCell($cell)->getValue();
    
            if($str==null &&$i>0){
                $max_column=$i;
                break;
            }

            $column_name=next_column($column_name);
        }
        
        while(True){
            $row=[];
            $column_name='A';
            $j=0;
            for($i=0;$i<$max_column;$i++){
                $cell=$column_name.$row_number;    
                $str=$worksheet->getCell($cell)->getValue();
    
                $row[]=$str;
                
                $column_name=next_column($column_name);
            }
            $data[]=$row;
            $row_number++;

            $str=$worksheet->getCell('A'.$row_number)->getValue();
            if($str=="")break ;
        }
        return $data;
    }


    function print_excel($result2,$names,$heads,$name){
        $objPHPExcel= new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $column_name='A';
        $row_number=1;
        for($i=0;$i<count($heads);$i++){
            $cell=$column_name.$row_number;    
            // $objPHPExcel->setCellValue($cell,$heads[$i]);
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($cell,$heads[$i]);
            $column_name=next_column($column_name);
        }

        $row_number=2;
        while($row=$result2->fetch_assoc()){
            $column_name='A';
            for($i=0;$i<count($names);$i++){
                $cell=$column_name.$row_number;    
                
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($cell,$row[$names[$i]]);

            $column_name=next_column($column_name);
            }
            $row_number++;
        }

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $objWriter->save($name);

        // header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment; filename ="'.$name.'"');
        // header('Cache-Control: max-age=0');
    }

    function data_extract($result,$names){
        $data=[];
        $j=0;
        while($row=$result->fetch_assoc()){
            $row_result=[];
            for($i=0;$i<count($names);$i++){   
            $row_result[$names[$i]]=$row[$names[$i]];
            }
            $j++;
            $data[]=$row_result;
        }
        return $data;
    }
    
    function data_extract_row($result,$name){
        $data=[];
        while($row=$result->fetch_assoc())$data[]=$row[$name];
        return $data;
    }

    function print_excel2($data,$names,$heads,$name){
        $objPHPExcel= new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $column_name='A';
        $row_number=1;
        for($i=0;$i<count($heads);$i++){
            $cell=$column_name.$row_number;    
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($cell,$heads[$i]);
            $column_name=next_column($column_name);
        }

        $row_number=2;
        for($i=0;$i<count($data);$i++){
            $column_name='A';
            for($j=0;$j<count($data[$i]);$j++){
                $cell=$column_name.$row_number;    
                
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($cell,$data[$i][$names[$j]]);

            $column_name=next_column($column_name);
            }
            $row_number++;
        }

        //set column size 
        $column_name2='A';
        while($column_name!=$column_name2){
            $objPHPExcel->getActiveSheet()->getColumnDimension($column_name2)->setAutoSize(true);
            $column_name2=next_column($column_name2);
        }

        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
        $objWriter->save($name);

        // header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // // header('Content-Disposition: attachment; filename ="'.$name.'"');
        // header('Content-Disposition: attachment: filename="' . $name . '"');
        // header('Cache-Control: max-age=0');
    }

    //returns the index of equal string from array (not -caseSensitive)
    //returns -1 if not found
    function string_array_index($array,$string){
        for($i=0;$i<count($array);$i++){
            if(strtolower($array[$i])==strtolower($string)) return $i;
        }
        return -1;
    }

    ?>

    