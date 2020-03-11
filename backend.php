<?php

$con=mysqli_connect('localhost','root','','crud');





extract($_POST);


if(isset($_POST['readrecord'])){
	
	$data='<table class="table table-bordered table-striped">
	
	<tr>
	
	<th>No.</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Mobile</th>
	<th>Edit Action</th>
	<th>Delete Action</th>
	
	
	
	
	</tr>';
	
	$q="select * from record";
	
	$result=mysqli_query($con,$q);
	
	if(mysqli_num_rows($result)>0)
	{
		
		$number=1;
		
		while($row=mysqli_fetch_array($result))
		{
			$data.='<tr>
			<td>'.$number.'</td>
			<td>'.$row['first'].'</td>
			<td>'.$row['last'].'</td>
			<td>'.$row['mail'].'</td>
			<td>'.$row['num'].'</td>
			<td>
			<button onclick="getuserdetail('.$row['id'].')" class="btn btn-warning">Update</button>
			</td>
			
			<td>
			
			<button onclick="removedetail('.$row['id'].')" class="btn btn-danger">Delete</button>
			
			
			</td>
			
			</tr>';
			$number++;
			
			
			
		}
		
		
	}	
	
	
	$data.='</table>';
	echo $data;
	
}





if( isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['mobile']) )

{
	$q="INSERT INTO `record`(`first`, `last`, `mail`, `num`) VALUES('$first','$last','$email','$mobile') ";
	
mysqli_query($con,$q);
	
	
}


//delete

if(isset($_POST['deleteid']))
{
	
	$userid=$_POST['deleteid'];
	
	$q="delete from record where id='$userid' ";
	
	mysqli_query($con,$q);
	
}
//
//get userid for update





if(isset($_POST['id'])&&isset($_POST['id'])!="")
{
	
	$user_id=$_POST['id'];
	$query="select*from record where id='$user_id'";
	if(!$result=mysqli_query($con,$query))
	{
		exit(mysqli_error());
		
	}
	
	$response=array();
	
	if(mysqli_num_rows($result) > 0)
	{
		while($row=mysqli_fetch_assoc($result))
		{
			$response=$row;
			
			
		}
		
	}
	
	else
	{
		$response['status']=200;
		$response['message']="Data Not Found";
		
	}
	//php has some inbuilt function to handle json
	//objects in php can be converted into json by using the php function json_encode()
	echo json_encode($response);
	
	
}
else
{
	$response['status']=200;
    $response['message']="Invalid Request";
}
///update table
if(isset($_POST['hidden_user_idup']))
{
	$hidden_user_idup=$_POST['hidden_user_idup'];
	$firstup=$_POST['firstup'];
	$lastup=$_POST['lastup'];
	$emailup=$_POST['emailup'];
	$mobileup=$_POST['mobileup'];
	
	$query="UPDATE `record` SET `first`='$firstup',`last`='$lastup',`mail`='$emailup',`num`='$mobileup' WHERE id='$hidden_user_idup'";

mysqli_query($con,$query);

}

?>