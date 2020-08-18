function GetXmlHttpObject() {
    var xmlHttp=null;
    try
    {
    // Firefox, Opera 8.0+, Safari
            xmlHttp=new XMLHttpRequest();
    }
    catch (e)
    {
    // Internet Explorer
            try
            {
                    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e)
            {
                    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
    }
    return xmlHttp;
}

$(document).ready(function(){
    
        
	$(".save-btn").click(function(e){
		e.preventDefault();
		if ($('#addUser').valid()) {
                    $("#addUser").submit();
		}
	});
	if(document.getElementById("alert")!=null) {
		setTimeout(function(){ $("#alert").fadeOut(); }, 3000);
	}
        
        if($(".downloadenable").val()=="1") {
            $(".download-btn").trigger("click");
        }
        
        
        
	$.validator.addMethod('alphanumericformat', function(value, element, param)
        {
            var _URL = window.URL;
            var  pattern=/^[A-z a-z.]+$/;
            var $el=$(element);
            return $el.val().match(pattern);          
        });
	
});

$("#addUser").validate
({
        rules: 
        {
            name:
            {
                required: true, 
                alphanumericformat: true
            },
            email:
            {        
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true,
                minlength:10,
                maxlength:10
            },
            city: {
                required: true,
                alphanumericformat: true
            }
        },
        messages: 
        {
            name: 
            {
                required: "Please enter user name",
                alphanumericformat: "Please enter user name in characters only"                        
            },
            email:
            {        
                required: "Please enter email",
                email: "Please enter email in email format"
            }, 
            phone: {
                required: "Please enter contact number",
                number: "Please enter contact number in numbers only",
                minlength: "Please enter contact number in 10 digits only",
                maxlength: "Please enter contact number in 10 digits only"
        },
            city: {
                required: "Please enter city",
                alphanumericformat: "Please enter city name in characters only"
                    
            }
			
        },
        errorElement: 'span',
        errorElementClass: 'pdt_error_class_validate',
        errorClass: 'pdt_error_class_validate',
        errorPlacement: function(error, element) {},
        highlight: function(element, errorClass, validClass) {
                $(element).addClass(this.settings.errorElementClass).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass(this.settings.errorElementClass).removeClass(errorClass);
        },
        onkeyup: false,
        onclick: false,
        onfocusout: false,
        errorPlacement: function (error, element) {  
			if ( element.is(":radio") ||  element.is(":checkbox")) 
			{
				error.insertAfter( element.parents('.row') );
			} else {
				error.insertAfter(element); 
			}
			error.fadeOut(5000, function() { $(this).remove(); });
       }
    
});

$(document).on("click",".download-btn",function() {
   window.location.href = $(this).attr("href");
});




