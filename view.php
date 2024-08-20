<?php
  $page_title = 'All Products';
  require_once('includes/load.php');


  $sql="SELECT * FROM report ";//query for geeting the data
  $query="SELECT count(id) FROM report  ";//query for getting
  
  //search criterias
  $conditions=[];
  // 1.enrol
  if(isset($_POST['enrol']) && $_POST['enrol']!="")
      $conditions[]=" enrol LIKE '%".$_POST['enrol']."%'";

  // 2.name
  if(isset($_POST['name']) && $_POST['name']!="")
      $conditions[]=" name LIKE '%".$_POST['name']."%'";

  // 3.sem
  if(isset($_POST['sem']) && $_POST['sem']!="")
      $conditions[]=" sem = '".$_POST['sem']."'";
  
  // 4.issueDate
  if(isset($_POST['issueDate']) && $_POST['issueDate']!="")
      $conditions[]=" issueDate = '".$_POST['issueDate']."'";
  
  //putting conditions in queries
  for($i=0;$i<count($conditions);$i++){
      if(!$i){
        $sql=$sql." WHERE ".$conditions[$i];
        $query=$query." WHERE ".$conditions[$i];
      }
      else{
        $sql=$sql." AND ".$conditions[$i];
        $query=$query." AND ".$conditions[$i];
      }
  }
  
  //order in the search
  $order="";
  $values=['examDate','issueDate','enrol','name','sem','sgpa','cgpa','SheetSrNo','passFail','ex','mobile'];
  if(isset($_POST['order'])){
      //getting the posted order 
      $order=$_POST['order'];

      $first_time=1;
      for($i=0;$i<count($values);$i++){
        if($order[$i]!='0'){
          if($first_time){
            $sql .= " ORDER BY ";
            $first_time=0;
          } 
          else $sql .= " , ";
        }
        
        if($order[$i]=='1') $sql .= $values[$i]." asc";
        else if($order[$i]=='2') $sql .= $values[$i]." desc";
      }
  }
  
  
  //putting offsets and limits
  $total=find_by_sql($query.";");
  $total=$total[0]['count(id)'];//total number of records
  $limit=15;
  $offset=0;
  
  if(isset($_POST['offset'])) $offset=$_POST['offset'];
  $sql = $sql." limit ".$limit." offset ".$offset.";";
  
  //running the query to get the table
  // echo $sql;
  // echo $query;
  // $results = $db->query($sql);
  // $results = find_all('report');
  $results = find_by_sql($sql);

  //------------------------------------------------------------------------------>
  //Search 
  //------------------------------------------------------------------------------>


?>
<?php include_once('header.php'); ?>
<form action='view.php' method='post' style='position:fixed;top:70px;' >
  <div class="col-md-12" style='position:fixed;bottom:10px;left:0px;z-index:98;'>
    <?php echo display_msg($msg); ?>
  </div>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading ">
        <!-- <div class="pull-right">
          <a href="add.php" class="btn btn-primary">Add</a>
        </div> -->
        <div style='display:flex;' >
          
          <!-- enrol -->
          <div class="col-md-6">
          <Label>Enrollment</Label>
            <input type="text" class="form-control" name="enrol" placeholder="Enrollment No" maxlength=12 <?php if(isset($_POST['enrol'])) echo "value =".$_POST['enrol']; ?>>
          </div>

          <!-- name -->
          <div class="col-md-6">
            <label >Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" maxlength <?php if(isset($_POST['enrol'])) echo "value =".$_POST['enrol']; ?>>
          </div>

          <!-- sem -->
          <div class="col-md-6">
          <label >Semester</label>
            <select class="form-control" name="sem" >
              <option value="">Semester</option>
              <?php
                for($i=1;$i<=8;$i++){
                  echo "<option value =\"$i\"";
                  if(isset($_POST['sem'])) if($_POST['sem']==$i) echo "selected";
                  echo ">";
                  if($i==1) echo $i."st";
                  else if($i==2) echo $i."nd";
                  else if($i==3) echo $i."rd";
                  else echo $i."th";
                  echo "</option>";
                }
              ?>
            </select>
          </div>

          <!-- issue date -->
          <div class="col-md-6">
              <Label style='font-size'>Issue Date</Label>
              <input type="date" class="form-control" name="issueDate" <?php if(isset($_POST['issueDate'])) echo "value =".$_POST['issueDate']; ?>>
          </div>

          <!-- exam date -->
          <div class="col-md-6">
            <Label>Exam Date</Label>
            <input type="month" class="form-control" name="examDate" placeholder="Exam Date"<?php if(isset($_POST['examDate'])) echo "value =".$_POST['examDate']; ?> >
          </div>
          <input type="hidden" id="order" name="order" value='<?php if(isset($_POST['order'])) echo $_POST['order'];else echo "00000000000" ?>'>
                      
    
          <!-- Search button -->
          <div class='col-md-6' >
              <button type="submit"class="btn btn-primary" >Search</button>
          </div>
        </div>
      </div>

      <div class="panel-body scrollbar" style='height:75vh;'>
        <table class="table table-main">
          <thead >
            <tr>
              <th class="text-center" >#</th>
              <th class="text-center order" style="/*width: 8%;*/">Exam Date</th>
              <th class="text-center order" style="/*width: 8%;*/">Issue Date</th>
              <th class="text-center order" style="/*width: 10%;*/">Enroll No</th>
              <th class="text-center order" style="/*width: auto;*/" >Name</th>
              <th class="text-center order" style="/*width: 3%;*/" >Sem</th>
              <th class="text-center order" style="/*width: 5%;*/" >SGPA</th>
              <th class="text-center order" style="/*width: 5%;*/" >CGPA</th>
              <th class="text-center order" style="/*width: auto;*/" >Sheet SR No</th>
              <th class="text-center order" style="/*width: 100px;*/">Pass/Fail</th>
              <th class="text-center order" style="/*width: 100px;*/">Student Type</th>
              <th class="text-center order" style="/*width: 100px;*/">Mobile</th>
              <th class="text-center " style="/*width: 5%;*/">Action</th>
            </tr>
          </thead>
          <tbody >
            <?php foreach ($results as $i => $result): ?>
              <tr>
                <td><?php echo $offset + $i + 1; ?></td>
                <td class="text-center "><?php echo substr(remove_junk($result['examDate']),0,-3); ?></td>
                <td class="text-center "><?php echo remove_junk($result['issueDate']); ?></td>
                <td class="text-center "><?php echo remove_junk($result['enrol']); ?></td>
                <td class="text-center "><?php echo remove_junk($result['name']); ?></td>
                <td class="text-center "><?php echo remove_junk($result['sem']); ?></td>
                <td class="text-center "><?php echo remove_junk($result['sgpa']); ?></td>
                <td class="text-center "><?php echo remove_junk($result['cgpa']); ?></td>
                <td class="text-center "><?php echo remove_junk($result['SheetSrNo']); ?></td>
                <td class="text-center "><?php if($result['passFail']) echo "<div style='color:green';>Pass</div>";else echo "<div style='color:red;'>Fail</div>" ?></td>
                <td class="text-center "><?php if($result['ex']) echo "<div style='color:red';>Ex</div>";else echo "<div style='color:Green;'>Regular</div>" ?></td>
                <td class="text-center "><?php echo remove_junk($result['mobile']); ?></td>
                <td>
                  <div class="btn-group">
                    <a href="edit.php?id=<?php echo $result['id']; ?>" class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="partials/delete.php?id=<?php echo $result['id']; ?>" class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <div class="limits">
          <!-- previous batch -->
          <?php if($offset>=$limit) : ?>
          <button type ="submit" name="offset" class="offset padding-tb-10 padding-lr-10 margin-left-15" value="<?php echo $offset-$limit; ?>"><?php echo $offset+1-$limit.'-'.$offset; ?></button>
          <?php else: ?> <p></p>
          <?php endif; ?>

          <!-- next batch -->
          <?php if($offset+$limit<$total): ?>
          <button type ="submit" name="offset"class="offset  padding-tb-10 padding-lr-10 margin-right-15" value="<?php echo $offset+$limit;?>"><?php echo $offset+1+$limit.'-';

          if($offset+2*$limit<$total) echo $offset+2*$limit.'</button>';
          else echo $total.'</button>';
          endif;
          ?>
          </div>
      </div>
    </div>
  </div>
</form>
<script>
  function stringReplace(string,index,character){
    string2="";
    for(i=0;i<string.length;i++){
      if(i==index)string2+=character;
      else string2+=string[i];
    }
    return string2;
  }

  //up and down
  order=document.querySelector("#order").value;
  heads=document.querySelectorAll('.order');
  for(let i=0;i<heads.length;i++){
    
    //adding order icons
    icon=document.createElement("i");
    if(order[i]==1) icon.classList.add("glyphicon","glyphicon-menu-up");
    if(order[i]==2) icon.classList.add("glyphicon","glyphicon-menu-down");

    heads[i].append(icon);

    //adding event listeners
    heads[i].addEventListener('click',()=>{
      order1=document.querySelector("#order");
      value = order1.value;
      
      if(value[i]==0) value=stringReplace(value,i,"1");
      else if(value[i]==1) value=stringReplace(value,i,"2");
      else value=stringReplace(value,i,"0");      

      order1.value = value;
      document.querySelector('form').submit();
    })
  }

</script>
<style>
  .col-md-6{
    width:15%;
    display:flex;
    align-items:flex-end;
    flex-wrap:wrap;
  }
  .order:hover{
    cursor:pointer;
    color:grey;
  }
  .order i{
    width:50px;
    font-size:10px;
  }
  .limits{
    display:flex;
    justify-content:space-between;
  }
  .limits button{
    border:none;
    background:white;
  }
  .limits button:hover{
    text-decoration:underline;
  }
  /* table th,table td{
    border:10px solid grey;
  } */
  /* td,th{
    display:block;
  }
  thead{
    position:fixed;
    background:white;
  }
  tbody{
    margin-top:40px;
  }
  table,thead,tbody,tr{
    display:flex;
    flex-wrap:wrap;
  } */
</style>
<?php include_once('footer.php'); ?>
