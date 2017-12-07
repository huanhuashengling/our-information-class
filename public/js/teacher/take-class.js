$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $('#close-lesson-log').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/teacher/updateLessonLog',
            data: {lessonLogId: $("#lesson-log-id").val(), action: "close-lesson-log"},
            success: function( data ) {
            	// alert(data);
                if ("true" == data) {
                	window.location.href = "/teacher/";
                } else {
                	alert('关闭失败!');
                }
            }
        });
    });

    $('.btn-success').on('click', function (e) {
        var postsId = (e.target.value).split(',')[0]; 
// alert(postsId);
        e.preventDefault();
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
                console.log(data);
                if ("false" == data) {

                } else {
                    $('#post-show').attr("src", data);
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
    });

    $('.rate-btn').on('click', function (e) {
        var data = {posts_id: $('#posts-id').val(), rate: $(this).attr("value")};
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/teacher/updateRate',
            data: data,
            success: function( data ) {
                // alert(data);
                if ("true" == data) {
                    window.location.href = "/teacher/takeclass";
                } else {
                    alert('评价失败!');
                }
            }
        });
    });

    $("#add-post-comment-btn").on('click', function (e) {
        var data = {posts_id: $('#posts-id').val(), content: $('#post-comment').val()};
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/teacher/createComment',
            data: data,
            success: function( data ) {
                if ("true" == data) {
                    window.location.href = "/teacher/takeclass";
                    alert('添加评论成功!');
                } else {
                    alert('添加评论失败!');
                }
            }
        });
    });

    $("#edit-post-comment-btn").on('click', function (e) {
        var data = {posts_id: $('#posts-id').val(), 
                    content: $('#post-comment').val(), 
                    comments_id: $("#edit-post-comment-btn").val()};
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/teacher/updateComment',
            data: data,
            success: function( data ) {
                if ("true" == data) {
                    window.location.href = "/teacher/takeclass";
                    alert('编辑评论成功!');
                } else {
                    alert('编辑评论失败!');
                }
            }
        });
    });
});