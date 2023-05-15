<?php
include("config.php");
if($_POST['id'])

 $id=$_POST['id'];
  

?>

        
       <div class="row" style="margin-left:-1%;" id="chkboxContainer">
    <div class="col-md-3" style="text-align:right">
      <label>Family Name</label>
    </div>
    <div class="col-md-3">
       <?php
     
     $sql=mysqli_query($con,"SELECT * FROM `tbl_family` where WId='$id'");
     ?>
     <select name="FamilyName" id="FamilyName" class="form-control" style="width:500px;" onChange="">
      
     <option value="0">---Select---</option>
     <?php
     while($row=mysqli_fetch_array($sql))
     {
     ?>
     <option value="<?php echo $row['FamilyId'] ?>"> <?php echo $row['FamilyName'];?> </option>
     <?php
     }
     ?>
     </select>
      </div></div><br />