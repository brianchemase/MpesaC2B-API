<html>
<head>
<title>Payment</title>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <br>
    <div class="col-md-12">
        <form method="POST" action="payment.php">
            <div class="row">
                <div class="col-md-3 pr-1">
                    <div class="form-group">
     <div class="form-group">
     <label>Phone <b style="color:red">*</b></label>
     <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="phone" class="form-control" placeholder="2547xxxxxxxx" required />  
	 </div>
     <br>
	 
	 <div class="form-group">
     <label>ACC No <b style="color:red">*</b></label>
     <input type="text" onkeyup="this.value = this.value.toUpperCase();" name="accno" class="form-control" value="PAYMENT TESTING" required/>  
	 </div>
     <br>
	 
	 <div class="form-group">
     <label>Transaction Description <b style="color:red">*</b></label>
     <input type="text" name="tdesc" class="form-control"  value="PAYMENT TESTING"   required />  
	 </div>
     <br>
	 
	 <div class="form-group">
     <label>Amount <b style="color:red">*</b></label>
     <input type="text" name="amount" class="form-control" value="1" required />  
	 </div>
                      <br>                  
                </div>
  <button class="btn btn-primary" name="save">Submit</button>
      </form>    
  </div>
</div>

</body>
</html>	  