


<?php
include ('config.php');
session_start();
$user=$_SESSION['lid'];
if(isset($_POST['submit']))
{
  $name=$_POST['name'];
  $address=$_POST['address'];
  $phonenumber=$_POST['phone'];
  $pin=$_POST['pin'];
  $city=$_POST['city'];

  
  $city=$_POST['city'];
  // $aadharno=$_POST['aadharno'];
  $result=mysqli_query($con,"SELECT rid from tbl_login where lid='$user' and role='3'");
  		$row=mysqli_fetch_array($result);
  	if($row>0)
		{
			$rid=$row["rid"];
            $sql = mysqli_query($con,"UPDATE tbl_register SET name='$name',phone='$phonenumber',address='$address',place='$city',pincode='$pin' WHERE rid='$rid'");
            echo "<script>alert('profile updated Successfully');window.location='index.php'</script>";
        }
    else
    {
      echo "<script>alert('Error');window.location='index.php'</script>";
    }   
    

    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <script>
    function Validstr1() 
      {
        var val = document.getElementById('name').value;
        if (!val.match(/^[A-Za-z ]*$/))
        {
          document.getElementById('msg').innerHTML="Only alphabets are allowed";
          document.getElementById('name').value = val;
          document.getElementById('name').style.color = "red";
          return false;
          flag=1;
        }
        else
        {
          document.getElementById('msg').innerHTML=" ";
          document.getElementById('name').style.color = "green";
          //return true;
        }
      }
    function Validstr2() 
      {
        var val = document.getElementById('lname').value;
        if (!val.match(/^[A-Za-z]*$/))
        {
          document.getElementById('lmsg').innerHTML="Only alphabets are allowed";
          document.getElementById('lname').value = val;
          document.getElementById('lname').style.color = "red";
          return false;
          flag=1;
        }
        else
        {
          document.getElementById('lmsg').innerHTML=" ";
          document.getElementById('lname').style.color = "green";
          //return true;
        }
      }
      //username                                       
      function Validstr() 
      {
        var val = document.getElementById('username').value;
        if (!val.match(/^[A-Za-z ]*$/))
        {
          document.getElementById('msg1').innerHTML="Start with a Capital letter & Only alphabets are allowed";
          document.getElementById('username').value = val;
          document.getElementById('username').style.color = "red";
          return false;
          flag=1;
        }
        if(val.length<4||val.length>10)
        {
          document.getElementById('msg1').innerHTML="Username between 4 to 10 characters";
          document.getElementById('username').value = val;
          document.getElementById('username').style.color = "red";
          return false;
          flag=1;
        }
        else
        {
          document.getElementById('msg1').innerHTML=" ";
          document.getElementById('username').style.color = "green";
          //return true;
        }
      }
      //email
      function Validateemail()
      {
        var email=document.getElementById('email').value;  
        var mailformat = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
        if(email.length<3||email.length>40 && email!="")
        {
         document.getElementById('email1').innerHTML="Invalid Email";
         document.getElementById('email').value = email;
         document.getElementById('email').style.color = "red";
         return false;
        }
        if(!email.match(/^[\w\+\'\.-]+@[\w\'\.-]+\.[a-zA-Z]{2,}$/))
        {  
         document.getElementById('email1').innerHTML="Please enter a valid email";  
         document.getElementById('email').value = email;
         document.getElementById('email').style.color = "red";
         return false;  
        }
        else
        {
         document.getElementById('email1').innerHTML=" ";
         document.getElementById('email').style.color = "green";
          // return true;
        }
      }
    //Username
    function Validateusername()
      {
        var email=document.getElementById('uname').value;  
        var mailformat = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
        if(email.length<3||email.length>40 && email!="")
        {
         document.getElementById('email2').innerHTML="Invalid Email";
         document.getElementById('uname').value = email;
         document.getElementById('uname').style.color = "red";
         return false;
        }
        if(!email.match(/^[\w\+\'\.-]+@[\w\'\.-]+\.[a-zA-Z]{2,}$/))
        {  
         document.getElementById('email2').innerHTML="Please enter a valid email";  
         document.getElementById('uname').value = email;
         document.getElementById('uname').style.color = "red";
         return false;  
        }
        else
        {
         document.getElementById('email2').innerHTML=" ";
         document.getElementById('uname').style.color = "green";
          // return true;
        }
      }
      //phone
     function Validphone() 
      {
        var val = document.getElementById('phonenumber').value;
        if (!val.match(/^[6789][0-9]{9}$/) && val!="")
       {
         document.getElementById('msg2').innerHTML="Only Numbers are allowed and must contain 10 number";
         document.getElementById('phonenumber').value = val;
          return false;
        }
        else
        {
         document.getElementById('msg2').innerHTML="";
          //   return true;
        }
      }
      //password
      function Password()
      {
        var pass=document.getElementById('password').value;
        consol.log(pass);
       //var patt= /^(?=.[0-9])(?=.[!@#$%^&])[A-Za-z0-9!@#$%^&]{7,15}$/;
       //var patt = /^[a-zA-Z0-9@#$%^&]{7,15}$/;
       var patt = /^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{7,15}$/;
       if(!pass.match(patt))
       {
          console.log(pass);
          document.getElementById('pass').innerHTML="Password must be 7 to 15 character with number and special character ";  
          document.getElementById('password').value = pass;
          document.getElementById('password').style.color = "red";
          return false;  
        }
        else
        {
          console.log(pass, "Green");
          document.getElementById('pass').innerHTML=" ";
          document.getElementById('password').style.color = "green";
         //return true;
        }
      }
      //confirmpassword
      function Password1()
      {
        var pass1=document.getElementById('password').value;
        var pass2=document.getElementById('password1').value;
       if(!pass1.match(pass2))
       {
         console.log(pass2);
         document.getElementById('pass2').innerHTML="Password must match";  
         document.getElementById('password1').value = pass;
         document.getElementById('password1').style.color = "red";
         return false;  
       }
       else
       {
          console.log(pass1, "Green");
          document.getElementById('pass1').innerHTML=" ";
         document.getElementById('password1').style.color = "green";
          //return true;
        }
      }
  
      function Val()
     {
       if(Validstr1()===false || Validstr()===false || ValidateEmail()===false || Validphone()==false || Password()===false || Password1()===false)
        {
          return false;
        }
      }
    
</script>




    <style>
        body {
            background-color: #e8f5ff;
            font-family: Arial;
          
  overflow-y: scroll;
  scrollbar-color: rebeccapurple green;
  scrollbar-width: thin;
        }
        .edit {
            position: absolute;
            color: #000000;
            right: 24%;
        }
        /* Main */
        .main {
            margin-top: 2%;
            margin-left: 21%;
          
            font-size: 28px;
            padding: 0 0px;
            width: 55%;
        }
        .main h2 {
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .main .card {
            background-color: #fff;
            border-radius: 18px;
            box-shadow: 1px 1px 8px 0 grey;
            height: auto;
            width: 850px;
            /* margin-bottom: 20px; */
            padding: 20px 0 20px 50px;
        }
        .main .card table {
            border: none;
            font-size: 16px;
            height: 270px;
            margin-left:auto; 
            margin-right:auto;
            width: 70%;   
        }
  input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
textarea, select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=date], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width: 85%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 16px 0;
  margin-left:50px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color:lightgrey;
  
  width:770px;
  padding: 20px;
}
  </style>
<body>

        <a  class="fa fa-arrow" href="profile.php">Back</a>
 
    <!-- Main -->
    <div class="main">
        
            <div class="card">
                <h1 style="margin-left:35%;">PROFILE</h1>

                <div class="card-body">
                    <form name="myForm" method="POST" onsubmit="return validation();">
                        <table>
                            <tbody>
                            <?php 
                            
                           $sql=mysqli_query($con,"SELECT l.*,r.* FROM tbl_login l inner join tbl_register r on r.rid=l.rid   WHERE l.role='3' AND l.lid='$user'");
                            while($row = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>                            
                                    <td>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="First Name" autocomplete="off" value="<?php echo $row['name'];?>" onkeyup="return Validstr1()"
                                                            required pattern="[a-zA-Z]{3,30}"
                                                            oninvalid="setCustomValidity('input is incorrect !!')" 
                                                                oninput="setCustomValidity('')"
                                                                    maxlength="30" onkeyup="return validation()" >
                                    </td>
                                    
                                </tr>
                               
                                <!-- <tr>
                                    <td>Adhar No</td>
                                    <td>:</td>
                                    <td>
                                    <input type="text" name="aadharno" placeholder="Aadharno" id="aadharno" min="13" maxlength="13"  >
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>
                                    <input  type="text" name="email" placeholder="Enter your email" id="email"  required pattern="/^[\w\+\'\.-]+@[\w\'\.-]+\.[a-zA-Z]{2,}$/" value="<?php echo $row['Email'];?>" onkeyup="return Validateemail()" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address'];?>"  required> </td>
                                </tr>
                                
                                <tr>
                                    <td>Phone number</td>
                                    <td>:</td>
                                    <td>
                                    <input type="text" class="form-control" value="<?php echo $row['phone'];?>" min="10" maxlength="10" id="phone" name="phone" required onkeyup="return Validphone()"
                                                                pattern="[0-9]{3}[0-9]{3}[0-9]{4}"
                                                                oninvalid="setCustomValidity('fill phoneno !!')"  
                                                                    oninput="setCustomValidity('')"
                                                                    maxlength="30"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pincode</td>
                                    <td>:</td>
                                    <td>
                                    <input type="text" class="form-control" value="<?php echo $row['pincode'];?>"  id="pin" name="pin" > 
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td>gender</td>
                                    <td>:</td>
                                    <td>
                                    <input type="radio"  name="gender" value="male" id="gender" style="size:20%;" required="required"/>Male  &nbsp;  
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio"  name="gender" value="female" id="gender" required="required">Female
                                    </td>
                                </tr> -->
                                <tr>
                                    <td>City</td>
                                    <td>:</td>
                                    <td>
                                    <?php
$con=mysqli_connect("localhost","root","","db_grocerystore");


$sql=mysqli_query($con,"select * from tbl_place WHERE plstatus=0"); 
?>

     
<select   name="city" onchange="showResult(this.value)" class="form-control m-bot15"  plceholder="place" required >
<option value="" disabled selected>Enter Your Place</option>
<?php
while($row=mysqli_fetch_array($sql))
{

?>
<option value="<?php echo $row[0] ?>" ><?php echo $row[1] ?></option>
<?php
	
}
?>
                                    </td>  
                                
                                <?php }
                                ?>
                            </tbody>

                        </table>
                            
                                <input type="submit" value="Update your account" id="btn" name="submit"></td>
                            
                    </form>
            </div>
        </div>
    </div>
    <!-- End -->
</body>
</html>

