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
	//alert("Hi");
	getBookingList();	
	
	
	$(document).on("click", ".selectall", function() {
		$(".booking_member_schedule_id").prop('checked', $(this).prop('checked'));
	});
	
	$(document).on('change', '.booking_free_time_schedule_from_date', function() {
	   verifyDates();       
    });
	
	$(document).on('change', '.booking_free_time_schedule_to_date', function() {
       verifyDates();       
    });
	
	$(document).on('click', '.editBtn', function() {
      window.location.href='edit-prebooking.php?booking_member_schedule_id='+$(this).attr("data-id");
    });
	
	$(document).on("click", ".deleteSelected", function() {
		if ($('input[name="booking_member_schedule_id"]').filter(':checked').length === 0) {
			swal
            ({
                title: '<font style="color:red;font-weight:bold;">Error</font>',
                text: '<font style="font-size:17px;">Please select any booking to delete</font>',
                type: 'error',
                confirmButtonClass: "btn-success"
            })
		} else {
			deleteBooking();
		}
	});
	
});



function formatDate(date) {
    var d = new Date(date);
	var month = d.getMonth() + 1;
    var day = d.getDate();
    var year = d.getFullYear();
	if (month < 9) {month = '0' + month};
    if (day < 10) {day = '0' + day};

    return [year, month, day].join('/');
}

function verifyDates() {
	var booking_free_time_schedule_from_date = $(".booking_free_time_schedule_from_date").val();
	var booking_free_time_schedule_to_date = $(".booking_free_time_schedule_to_date").val();
	
	var from_date;
	var to_date;
	var span;
	var flag = false;
	if(booking_free_time_schedule_from_date !== "" && booking_free_time_schedule_to_date !== "") {
		from_date = formatDate(booking_free_time_schedule_from_date);
		to_date = formatDate(booking_free_time_schedule_to_date);
		//alert(from_date);
		//alert(to_date);
		
		if(from_date >= to_date) {
			span = "<span class='pdt_error_class_validate'>To date should be less than from date</span>";
			flag = true;
		}
		
		if(flag === true) {
			 $(span).insertAfter($(".booking_free_time_schedule_to_date"));
			 $(".pdt_error_class_validate").fadeOut(5000);
			 $(".booking_free_time_schedule_to_date").val("");
		} else {
			getBookingList();	
		}
	} else {
		getBookingList();		
	}
}

function deleteBooking() {
	swal({
    title: '<font style="color:red;font-weight:bold;">Are you sure, you want to delete this booking?</font>',
    text: "<font style='font-size:17px;'>You won't be able to revert this!</font>",
    type: 'warning',
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    cancelButtonColor: "#CCCCCC",
    confirmButtonText: 'Yes, delete it!',
    showLoaderOnConfirm: true,
    allowOutsideClick: false     
    }).then(function()
    {
		var url = "getBookingList.php";
		client_delete=GetXmlHttpObject();
        if (client_delete==null)
        {
              alert ("Your browser does not support AJAX!");
              return;
        }
	   var formData = new FormData();
	   $('input[name="booking_member_schedule_id"]:checked').each(function() {
			formData.append("booking_member_schedule_id[]",$(this).val());
	   });
	   formData.append("cmd","Delete");
	   client_delete.open("POST", url, true);
	   client_delete.setRequestHeader("enctype", "multipart/form-data");
	   client_delete.send(formData);
	   client_delete.onreadystatechange = function() {
		if (client_delete.readyState === 4) {
        	if (client_delete.status === 200) {
				response_delete=JSON.parse(client_delete.responseText);
				if(response_delete.errors === false) {
					swal
					({
						title: '<font style="color:green;font-weight:bold;">Record deleted successfully</font>',
						text: "<font style='font-size:17px;'>"+response_delete.message+"</font>",
						type: 'success',
						confirmButtonClass: "btn-success",
						showLoaderOnConfirm: true,
						allowOutsideClick: false    
				
					}).then(function()
					{
						$('input[name="booking_member_schedule_id"]').prop("checked", false);	
						getBookingList();						
					});
				} else {
					swal
					({
						title: '<font style="color:red;font-weight:bold;">Error</font>',
						text: "<font style='font-size:17px;'>"+response_delete.message+"</font>",
						type: 'error',
						confirmButtonClass: "btn-success",
						showLoaderOnConfirm: true,
						allowOutsideClick: false    
				
					}).then(function()
					{
						$('input[name="selectall"]').prop("checked", false);
            			$('input[name="booking_member_schedule_id"]').prop("checked", false);	
						getBookingist();
					});	
				}
			}
		}
	  }
	}, function(dismiss)
    {
        if(dismiss == 'cancel') {
            $('input[name="selectall"]').prop("checked", false);
            $('input[name="booking_member_schedule_id"]').prop("checked", false);
        }
    });
}




function getBookingList() {
	var promiseObj = new Promise(function(resolve, reject) {
		client_calendar=GetXmlHttpObject();
		if (client_calendar==null) {
			alert ("Your browser does not support AJAX!");
			return;
		}
		var url = "getBookingList.php";
		var message = "";
		var formData = new FormData();
		//alert($(".booking_prayer_group_id_edit").val());
		formData.append("booking_free_time_schedule_from_date",$(".booking_free_time_schedule_from_date").val());
		formData.append("booking_free_time_schedule_to_date",$(".booking_free_time_schedule_to_date").val());
		formData.append("cmd","List");
		formData.append("booking_member_schedule_status","booked");
        client_calendar.open("POST", url, true);
		client_calendar.setRequestHeader("enctype", "multipart/form-data");
		client_calendar.send(formData);
		$("#myTable").html("<tr><td colspan='6' style='text-align:center;'><div class='spinner-border text-primary'></div></td></tr>");	
		client_calendar.onreadystatechange = function() {
            if (client_calendar.readyState === 4) {
                if (client_calendar.status === 200) {
					var x='';
					response_calendar=JSON.parse(client_calendar.responseText);
					$(".listHeading").text("Displaying from "+response_calendar.fromDate+" to "+response_calendar.toDate);
					if(response_calendar.errors == false && response_calendar.success == true && response_calendar.data.length > 0) {
						$.each(response_calendar.data,function(key, value){	
							x = x + '<tr>' +
								'<td><input type="checkbox" value ="'+ value.booking_member_schedule_id + '" class = "booking_member_schedule_id" name="booking_member_schedule_id"></td>' + 
								'<td>'+ value.prayerGroupName +'</td><td>' + value.memberName + '</td><td>' + value.registerDate + '</td><td>' + value.bookingDateTime + '</td><td>' + value.timeSlot + '</td>';
							
							x = x + '<td><button class="btn blue editBtn" data-id="' + value.booking_member_schedule_id + '">Edit</button></td></tr>';
						});
						$("#myTable").html(x);
					} else {
						$("#myTable").html("<tr><td colspan='7' style='text-align:center;'>No records found</td></tr>");	
					}
				}
			}
		}
	});
}

