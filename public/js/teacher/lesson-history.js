$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

    $(document)
        .on('click', '.panel-title', function(e) {
            e.preventDefault();
            var lessonsId = $(this).attr("value");
	        $.ajax({
	            type: "POST",
	            url: '/teacher/getLessonPostPerSclass',
	            data: {lessons_id: lessonsId},
	            success: function( data ) {
	            	// console.log(data);
	            	$("#lesson"+lessonsId).closest(".panel-body").html(data);
	            }
	        });
        })
		.on('click', '.post-btn', function(e) {
	        e.preventDefault();
	        if ($(".rate-btn").hasClass('active')) {
	          	setTimeout(function() {
	            	$(".rate-btn").removeClass('active').find('input').prop('checked', false);
	          	}.bind(this), 10);
	        }
	        $('#post-comment').val("");
	        var postsId = (e.target.value).split(',')[0]; 
	        $.ajax({
	            type: "POST",
	            url: '/teacher/getPostRate',
	            data: {posts_id: postsId},
	            success: function( data ) {
	                if ("false" == data) {

	                } else {
	                    $('#'+data+'-rate').addClass("active");
	                }
	            }
	        });

	        $.ajax({
	            type: "POST",
	            url: '/teacher/getPost',
	            data: {posts_id: postsId},
	            success: function( data ) {
	                // console.log(data);
	                if ("false" == data) {

	                } else {
	                    $('#post-show').attr("src", data);
	                    $('#post-download-link').attr("href", data);

	                }
	            }
	        });

	        $.ajax({
	            type: "POST",
	            url: '/teacher/getCommentByPostsId',
	            data: {posts_id: postsId},
	            success: function( data ) {
	                if ("false" == data) {
	                    $("#edit-post-comment-btn").addClass("hidden");
	                    $("#add-post-comment-btn").removeClass("hidden");
	                } else {
	                    var comment = JSON.parse(data);
	                    $("#edit-post-comment-btn").val(comment['id']);
	                    $('#post-comment').val(comment['content']);
	                    $("#edit-post-comment-btn").removeClass("hidden");
	                    $("#add-post-comment-btn").addClass("hidden");
	                }
	            }
	        });

	        $('#posts-id').val(postsId);
	        // $('#post-show').attr("src", filePath);
	        $('#myModal').modal();
	    })
});