<?php
	
	
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>User Data</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
		
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
	
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/bootstrap4/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.min.css')}}">
	
		
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


     
<script src="{{asset('assets/bootstrap4/js/bootstrap.min.js')}}"></script>
<style type="text/css">
.pdt_error_class_validate {
    color:#FF0000;
    font-style:italic;
    font-size:15px;
    text-align:left;
    font-weight: bold;
}
</style>

</head>

<body>
<!-- Start Welcome area -->
    <div class="all-content-wrapper">
        
		
        <div class="contacts-area mg-b-15">
		
		
		<div class="row">
		<div class="col-md-12">
			<div class="container-fluid">	
                            <br>		
                
				
				
				
                                
                                
    
                <div class="modal-body">
                    <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @if(Session::has('vmessage'))
                        <div class="alert alert-success alert-dismissible" role="alert" id="alert">
                                {{ Session::get('vmessage') }}                  
                            </div>
                        @endif
                        <input type="hidden" value="{{ Session::has('vmessage') ? '1' : '' }}" class="downloadenable" />
                        
                        <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">
                            <div class="panel-body custom-panel-jw">
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
									 <div class="form-group text-center">
										<h4 class="blue-text">Add / Edit User</h4>
									  </div>
									  <div class="form-group text-center"><br>
										<i class="fa fa-users" aria-hidden="true" style="font-size: 121px;"></i>
									  </div>
									  
									 
								</div>
								<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
								
                                                                    <form method="post" id="addUser" action="{{ route('doRegister') }}"> 
									  <input type="hidden" name="_token" value="{{ csrf_token() }}">
									  <div class="form-group col-md-4 pl-pr-0">
										<label for="exampleInputEmail1">User Name</label>
									  </div>
									  <div class="form-group col-md-8 pl-pr-0">
										<input type="text" class="form-control name" placeholder="Enter Name" name="name" id="name" value="{{ old('name') ? old('name') : '' }}">
                                                                                @if ($errors->any() && $errors->has('name'))
                                                                                <span class="pdt_error_class_validate" style="color:red; font-style: italic;">
                                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                                </span>
                                                                                @endif
									  </div>
									  <div class="form-group col-md-4 pl-pr-0">
										<label for="exampleInputEmail1">User Email</label>
									  </div>
									  <div class="form-group col-md-8 pl-pr-0">
										<input type="text" class="form-control email" placeholder="Enter Email" name="email" id="email" value="{{ old('email') ? old('email') : '' }}">
                                                                                @if ($errors->any() && $errors->has('email'))
                                                                                <span class="pdt_error_class_validate" style="color:red; font-style: italic;">
                                                                                        <strong>{{ $errors->first('email') }}</strong>
                                                                                </span>
                                                                                @endif
									  </div>
									  
									  <div class="form-group col-md-4 pl-pr-0">
										<label for="exampleInputEmail1">User Phone</label>
									  </div>
									  <div class="form-group col-md-8 pl-pr-0">
										<input type="text" class="form-control phone" placeholder="Enter Phone" name="phone" id="phone" value="{{ old('phone') ? old('phone') : '' }}">
                                                                                @if ($errors->any() && $errors->has('phone'))
                                                                                <span class="pdt_error_class_validate" style="color:red; font-style: italic;">
                                                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                                                </span>
                                                                                @endif
									  </div>
									   
									   <div class="form-group col-md-4 pl-pr-0">
										<label for="exampleInputEmail1">User City</label>
									  </div>
									  <div class="form-group col-md-8 pl-pr-0">
										<input type="text" class="form-control city" placeholder="Enter City" name="city" id="city" value="{{ old('city') ? old('city') : '' }}">
                                                                                @if ($errors->any() && $errors->has('city'))
                                                                                <span class="pdt_error_class_validate" style="color:red; font-style: italic;">
                                                                                        <strong>{{ $errors->first('city') }}</strong>
                                                                                </span>
                                                                                @endif
									  </div>
									  
									  <div class="form-group col-md-12">
                                                                              <button class="blue save-btn btn btn-primary">Save</button> <a class="blue download-btn btn btn-primary" style="display: none;" href="{{ route('download',['file' => "users.xlsx"]) }}">Download</a>
									  </div>
									  
								  </form>
								 </div>
                            </div>
                            
                        </div>
                    </div>
					
			
					
                </div>
                </div>
                
           
				
				
                
            </div>
		</div>
		
		
            
        </div>
		
		
		
		
		

    </div>
    </div>

<script type="text/javascript" src="{{asset('assets/js/validate.js')}}"></script>  
<script type="text/javascript" src="{{asset('assets/js/additionalmethod.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/userData.js')}}"></script>
   
</body>



</html>