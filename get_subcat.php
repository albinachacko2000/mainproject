<?php
 include 'config.php';
 $category_id=$_POST["category_id"];
 $result = mysqli_query($con,"SELECT * FROM tbl_subcategory where cid=$category_id");
?>
<option value="">Select SubCategory</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
 <option value="<?php echo $row["sid"];?>"><?php echo $row["subname"];?></option>
<?php
}
?>