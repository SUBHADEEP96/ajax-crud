<!DOCTYPE html>
<html>
<head>
<title>Euresia Decor - Managers Copy</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container"><br><br>
<h1 class="text-primary text-uppercase text-center">Manager's Master Copy</h1>

<div class="d-flex justify-content-end">
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
  Add More
</button>
</div>

<h2 class="text-warning">All Records</h2>

<div id="record"></div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Manager's Board</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
		
		<label>Firstname:</label>
		<input type="text" name="" id="first" class="form-control" placeholder=" ">
		
		
		</div>
		
		<div class="form-group">
		
		<label>Lastname:</label>
		<input type="text" name="" id="last" class="form-control" placeholder=" ">
		
		
		</div>
		
		
		<div class="form-group">
		
		<label>Email-Id:</label>
		<input type="email" name="" id="email" class="form-control" placeholder=" ">
		
		
		</div>
		
		<div class="form-group">
		
		<label>Mobile:</label>
		<input type="text" name="" id="mobile" class="form-control" placeholder=" ">
		
		
		</div>
		
		
		
		
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addrecord()">Save</button>
      
	  
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
 
</div>

<!--update modal-->
<!-- The Modal -->
<div class="modal" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Manager's Board</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
		
		<label>Firstname:</label>
		<input type="text" name="" id="upfirst" class="form-control" placeholder=" ">
		
		
		</div>
		
		<div class="form-group">
		
		<label>Lastname:</label>
		<input type="text" name="" id="uplast" class="form-control" placeholder=" ">
		
		
		</div>
		
		
		<div class="form-group">
		
		<label>Email-Id:</label>
		<input type="email" name="" id="upemail" class="form-control" placeholder=" ">
		
		
		</div>
		
		<div class="form-group">
		
		<label>Mobile:</label>
		<input type="text" name="" id="upmobile" class="form-control" placeholder=" ">
		
		
		</div>
		
		
		
		
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updatedetail()">Update</button>
      
	  
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		<input type="hidden" name="" id="hidden">
      </div>

    </div>
  </div>
 
</div>





</div><!--end of container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>/*--for ajax--*/

$(document).ready(function(){
	readrecord();
	
});



function readrecord(){
	
	var readrecord ="readrecord";
	
	$.ajax({
		
		url:"backend.php",
		type:"post",
		data:{readrecord:readrecord},
		success:function(data,status){
			
			$('#record').html(data);
		}
		
		
		
	});
	
}



function addrecord(){
	
	var first=$('#first').val();
	var last=$('#last').val();
	var email=$('#email').val();
	var mobile=$('#mobile').val();
	/*The ajax() method is used to perform an AJAX (asynchronous HTTP) request */
	$.ajax({
		url:"backend.php",
		type:'post',
		data:{
			
			first:first,
			last:last,
			email:email,
			mobile:mobile,
			
			},
			
		success:function(data,status){
			readrecord();
			
		}
		
	});
}

////delete function

function removedetail(deleteid){
	
	var conf=confirm("Are you Sure?");
	
	if(conf==true){
		
		$.ajax({
			url:"backend.php",
			type:"post",
			data:{deleteid:deleteid},
			success:function(data,status){
				readrecord();
				
			}
			
			
			
		});
		
	}
	
	
}
//update
function getuserdetail(id){
	$("#hidden").val(id);
	/*in post there are three url,data,and callback*/
	//$.post :it will load data from server using a http resquest
	$.post("backend.php",{
		id:id
		},
	
	function(data,status){
		var user=JSON.parse(data);
		
		$('#upfirst').val(user.first);
		$('#uplast').val(user.last);
		$('#upemail').val(user.mail);
		$('#upmobile').val(user.num);
		
		
	}
	
	);
	$('#update_user_modal').modal("show");
}


function updatedetail()
{
	var firstup=$('#upfirst').val();
	var lastup= $('#uplast').val();
    var emailup= $('#upemail').val();
    var mobileup=$('#upmobile').val();	
	
	var hidden_user_idup=$('#hidden').val();
 
 $.post("backend.php",
 {
	  hidden_user_idup:hidden_user_idup,
	  firstup:firstup,
	  lastup:lastup,
	  emailup:emailup,
	  mobileup:mobileup
	  
  },
  
  function(data,status)
  {
	  $('#update_user_modal').modal("hide");
	  readrecord();
  }
  
  );
	
}
</script>
</body>
</html>