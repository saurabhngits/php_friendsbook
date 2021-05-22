//home.php profile.php
/*--------------------***- To show preview of Image or video -***----------------*/

function show_preview(input) {
	$('#myModal_for_posting').modal();

	var filename = $(input).val();
	var extension = filename.replace(/^.*\./, '');
	if (extension == filename) {
            extension = '';
    } 
	else {
            extension = extension.toLowerCase();
    }
	
	if (extension == 'mp4') {
		$('#my_posting_img_preview').css({"display": "none"});
		$('#my_posting_video_container').css({"display": "block"});
		var fileUrl = window.URL.createObjectURL(input.files[0]);
		var $destination =  $('#my_posting_video_preview');
		$destination.attr("src", fileUrl);
		$destination.parent()[0].load();
	}
	else if(extension == 'jpg' || extension == 'png' || extension == 'gif'){
		//reading URL 
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#my_posting_video_container').css({"display": "none"});
				$('#my_posting_img_preview').css({"display": "block"});
				$('#my_posting_img_preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
}

$("#my_upload_file").change(function() {
	show_preview(this);
});

/*-------------------***- //To show preview of Image or video -***---------------*/

/*------------------------------***- Posting Modal -***--------------------------*/

$("#my_post").on("click",function(){
	var check1 = document.getElementById("post_name");
	var check2 = document.getElementById("post_status");
	var name = $("#post_name").val();
	var desc = $("#post_desc").val();
	var put_status = $("#post_status").val();
	
	if(name == "" || put_status == ""){
		check1.setCustomValidity("Please enter name of post");
		check1.focus();
		check1.autofocus;
		check2.setCustomValidity("Please select status");
		check2.focus();
		check2.autofocus;
	}
	else {
		$("#my_upload_file_desc").val(desc);
		$("#my_upload_file_name").val(name);
		$("#my_upload_file_status").val(put_status);
		document.getElementById("my_file_upload_form").submit(); 
	}
});

$('#post_desc').emojioneArea({
   pickerPosition:"top",
   toneStyle: "bullet"
});

$('#my_user_status').emojioneArea({
   pickerPosition:"bottom",
   toneStyle: "bullet"
});

/*-----------------------------***- //Posting Modal -***-------------------------*/

/*----------------------------***- Post like's status -***-----------------------*/


$(".show_like_details").on("click",function(){
	var post_id = $(this).attr('id');
	var actual_id = post_id.replace("post","");
	var like_span_id = "like_for_postid_"+actual_id;
	var check = "for_on_click"
	
	$.ajax({
		url : "ajax/ajax_show_like_details.php",
		method : "POST",
		data: { temp1:actual_id, temp2:check },
		success: function(data){ 
			$("#"+like_span_id).html(data);
		}
	});
	
	$("#"+post_id).toggleClass("active_element");
});

$(".show_liker_id").on("click",function(){
	var post_id = $(this).attr('id');
	var actual_id = post_id.replace("show_liker_id_","");
	var check = "for_on_click"
	
	$.ajax({
		url : "ajax/ajax_show_like_details.php",
		method : "POST",
		data: { temp3:actual_id, temp4:check },
		success: function(data){ 
			$("#show_liker_names").html(data);
		}
	});
});

/*---------------------------***- //Post like's status -***----------------------*/

/*------------------------***- Change Post or Delete Post -***-------------------*/
$(document).ready(function(){
	$(".change_post_status").on("click",function(){
		var security_status = $(this).attr('my_post_status_data');
		var post_id = $(this).attr('my_post_id');
		window.location.href = "edit_post.php?temp_status="+""+security_status+"&&temp_id="+post_id+""; 
	}); 
});

$(document).ready(function(){
	$(".delete_post").on("click",function(){
		var post_id = $(this).attr('my_post_id');
		window.location.href = "edit_post.php?temp_id_delete="+post_id+""; 
	});
});


/*-----------------------***- //Change Post or Delete Post -***------------------*/


//profile.php
/*--------------------------***- changing cover photo -***-----------------------*/
// $(document).ready(function(){
if($('#my_cover_file_image_demo').length){
	$image_crop = $('#my_cover_file_image_demo').croppie({
		enableExif: true,
		viewport: {
			width:851,
			height:315,
			type:'square' //circle
		},
		boundary:{
			width:861,
			height:325
		}
	});

	$('#my_cover_file').on('change', function(){
		var reader = new FileReader();
		reader.onload = function (event) {
			$image_crop.croppie('bind', {
				url: event.target.result
			}).then(function(){
				console.log('jQuery bind complete');
			});
		}
		reader.readAsDataURL(this.files[0]);
		$('#my_cover_file_modal').modal('show');
	});

	$('#my_crop_image').on("click", function(event){
		$image_crop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function(response){
			$.ajax({
				url:"ajax/ajax_profile_photo_uploader.php",
				type: "POST",
				data:{"image": response},
				success:function(data)
				{
					$('#my_cover_file_modal').modal('hide');
					$('#uploaded_image').html(data);
				}
		  });
		})
	});
	
	$('#remove_my_cover_file').on("click", function(event){
		var answer = confirm("Are you sure, that want\'s to remove cover photo ?");
		if(answer){
			var response = "remove_my_cover_file";
			$.ajax({
				url:"ajax/ajax_profile_photo_delete.php",
				type: "POST",
				data:{"temp": response},
				success:function(data)
				{
					$('#uploaded_image').html(data);
				}
			});
		}
	});
}
// }); 



/*-------------------------***- //changing cover photo -***----------------------*/

/*--------------------------***- changing profile photo -***---------------------*/
$(document).ready(function(){
	if($('#my_profile_file_image_demo').length){
		$image_profile_crop = $('#my_profile_file_image_demo').croppie({
			enableExif: true,
			viewport: {
				width:142,
				height:142,
				type:'square' //circle
			},
			boundary:{
				width:242,
				height:242
			}
		});

		$('#my_profile_file').on('change', function(){
			var reader = new FileReader();
			reader.onload = function (event) {
				$image_profile_crop.croppie('bind', {
					url: event.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});
			}
			reader.readAsDataURL(this.files[0]);
			$('#my_profile_file_modal').modal('show');
		});

		$('#my_crop_image2').click(function(event){
			$image_profile_crop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function(response){
				$.ajax({
					url:"ajax/ajax_profile_photo_uploader.php",
					type: "POST",
					data:{"image2": response},
					success:function(data)
					{
						$('#my_profile_file_modal').modal('hide');
						$('#uploaded_image').html(data);
					}
			});
			})
		});
		
		$('#remove_my_profile_file').click(function(event){
			var answer = confirm("Are you sure, that want\'s to remove profile photo ?");
			if(answer){
				var response = "remove_my_profile_file";
				$.ajax({
					url:"ajax/ajax_profile_photo_delete.php",
					type: "POST",
					data:{"temp": response},
					success:function(data)
					{
						$('#uploaded_image').html(data);
					}
				});
			}
		});
	}
}); 



/*-------------------------***- //changing profile photo -***--------------------*/

/*------------------------------***- Friend request -***-------------------------*/
$(document).ready(function(){
	$(".request_sender_btn").on("click",function(){
		var friends_email = $(this).attr('friends_email');
		$.ajax({
				url:"ajax/ajax_friend_request.php",
				type: "POST",
				data:{"temp_friends_email": friends_email},
				success:function(data)
				{
					$('#uploaded_image').html(data);
					window.location.href = "";
				}
		});
	});
});

$(document).ready(function(){
	$(".delete_request_btn").on("click",function(){
		var friends_email = $(this).attr('friends_email');
		var request_id = $(this).attr('request_id');
		$.ajax({
				url:"ajax/ajax_friend_request.php",
				type: "POST",
				data:{"temp_delete_id": request_id},
				success:function(data)
				{
					$('#uploaded_image').html(data);
					window.location.href = "";
				}
		});
	});
});

$(document).ready(function(){
	$(".accept_request_btn").on("click",function(){
		var friends_email = $(this).attr('friends_email');
		var request_id = $(this).attr('request_id');
		$.ajax({
				url:"ajax/ajax_friend_request.php",
				type: "POST",
				data:{"temp_accept_id": request_id},
				success:function(data)
				{
					$('#uploaded_image').html(data);
					window.location.href = "";
				}
		});
	});
});


/*----------------------------***- //Friend request -***-------------------------*/


/*----------------------------***- Search For Friends -***-----------------------*/
$(document).ready(function(){  
    $('#show_friend_search').keyup(function(){  
		var query = $(this).val();  
		if(query != ''){  
			$.ajax({  
				url:"ajax/ajax_list_friend_search.php",  
				method:"POST",  
				data:{query:query},  
				success:function(data)  
				{  
					$('#show_friend_search_result').fadeIn();  
					$('#show_friend_search_result').html(data);  
				}  
			});  
		}  
    });  
	$(document).on('click', '.show_friend_search_li', function(){  
		$('#show_friend_search').val($(this).text());  
		$('#show_friend_search_result').fadeOut();  
	});  
	$(document).on('click', function(){    
		$('#show_friend_search_result').fadeOut();  
	}); 
 });  

/*---------------------------***- //Search For Friends -***----------------------*/

/*----------------------------***- Show Friend Request-***-----------------------*/
$(document).ready(function(){  
    $('#show_friend_request').click(function(){
		var temp = "1";
		$.ajax({  
			url:"ajax/ajax_list_friend_request.php",  
			method:"POST",  
			data:{query:temp},  
			success:function(data)  
			{  
				$('#show_friend_request_result').fadeIn();  
				$('#show_friend_request_result').html(data);  
			}  
		});
    });  
	$(document).on('click', function(){    
		$('#show_friend_request_result').fadeOut();  
	}); 
 });

/*---------------------------***- //Show Friend Request-***----------------------*/

/*--------------------------***- Count Friend Request -***-----------------------*/
    window.onload = function(){
		var temp = "1";
		$.ajax({  
			url:"ajax/ajax_count_friend_request.php",  
			method:"POST",  
			data:{query:temp},  
			success:function(data)  
			{  	
				if(data>0){
					$('#show_friend_request').addClass('active');
					$('#total_friend_request').fadeIn();  
					$('#total_friend_request').html(data);
				}  
			}  
		});
    } 
/*-------------------------***- //Count Friend Request -***----------------------*/

/*--------------------------------***- messenger -***----------------------------*/
$(document).ready(function(){  

	$('#msg_writer').emojioneArea({
	   pickerPosition:"top",
	   toneStyle: "bullet"
	});

	// window.onload = function(){
	// 	var friend_id = $('.active').attr('friend_id');
	// 	$("#msg_writer").attr('friend_id',friend_id);
	// 	$.ajax({  
	// 		url:"ajax/ajax_show_messages_box.php",  
	// 		method:"POST",  
	// 		data:{friend_id:friend_id},  
	// 		success:function(data)  
	// 		{   
	// 			$('#my_messenger_box').html(data);
	// 			$('#msg_box_footer').css({"display":"block"})
	// 		}  
	// 	});
	// }
	
    $('.my-messeng-friend').click(function(){
		$('.my-messeng-friend').removeClass('active');
		$(this).addClass('active');
		var friend_id = $(this).attr('friend_id');
		$("#msg_writer").attr('friend_id',friend_id);
		$.ajax({  
			url:"ajax/ajax_show_messages_box.php",  
			method:"POST",  
			data:{friend_id:friend_id},  
			success:function(data)  
			{   
				$('#my_messenger_box').html(data);
				$('#msg_box_footer').css({"display":"block"})
			}  
		});
    });  
 });

$(document).ready(function(){
	$('#msg_sender').click(function(){
		var friend_id = $("#msg_writer").attr('friend_id');
		var msg = $("#msg_writer").val();
		var textarea = document.querySelector('#msg_writer');
		$.ajax({  
			url:"ajax/ajax_show_messages_box.php",  
			method:"POST",  
			data:{friend_id:friend_id, msg:msg},  
			success:function(data)  
			{   
				$('#my_messenger_box').html(data);
				$('#msg_box_footer').css({"display":"block"});
				textarea.value = '';
				
			}  
		});
	});
});

/*
$(document).ready(function(){
	$('#search_friend_for_message').keyup(function(){
		var query = $(this).val();
		$.ajax({  
			url:"ajax/ajax_show_messages_box.php",  
			method:"POST",  
			data:{query:query},  
			success:function(data)  
			{   
				$('#show_friend_for_message').html(data);
			}  
		});
	});
});*/
 
 
/*-------------------------------***- //messenger -***---------------------------*/




