$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

    $('img').on('click', function (e) {
        e.preventDefault();
        if ($(".rate-btn").hasClass('active')) {
          setTimeout(function() {
            $(".rate-btn").removeClass('active').find('input').prop('checked', false);
          }.bind(this), 10);
        }
        $('#classmate-post-comment').val("");
        console.log($(this).attr("value"));
        // var postsId = (e.target.value).split(',')[0]; 
        var postsId = $(this).attr("value");
        $('#classmate-post-show').attr("src", "");
        $.ajax({
            type: "POST",
            url: '/student/getPostRate',
            data: {posts_id: postsId},
            success: function( data ) {
                if ("false" == data) {

                } else {
                }
            }
        });

        $.ajax({
            type: "POST",
            url: '/student/getOnePost',
            data: {posts_id: postsId},
            success: function( data ) {
                console.log(data);
                if ("false" == data) {

                } else {
                    $('#classmate-post-show').attr("src", data);
                }
            }
        });

        $.ajax({
            type: "POST",
            url: '/student/getCommentByPostsId',
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
        $('#classmate-post-modal').modal();
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
                    // window.location.href = "/teacher/takeclass";
                    $('#myModal').modal("hide");
                } else {
                    alert('评价失败!');
                }
            }
        });
    });
});