$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$('.btn-success').on('click', function (e) {
        var postsId = (e.target.value).split(',')[0]; 
        var filePath = (e.target.value).split(',')[1]; 

        e.preventDefault();
        $.ajax({
            type: "GET",
            url: '/teacher/getPostRate',
            data: {posts_id : postsId},
            success: function( data ) {
                if ("false" == data) {
                } else if ("outstanding" == data) {
                    $('#rate-label').text("优秀");
                } else if ("good" == data) {
                    $('#rate-label').text("良好");
                } else if ("lower" == data) {
                    $('#rate-label').text("合格");
                }
            }
        });

        $.ajax({
            type: "GET",
            url: '/teacher/getCommentByPostsId',
            data: {posts_id : postsId},
            success: function( data ) {
            	console.log(data);
                if ("false" == data) {
                	$('#post-comment').val("暂无");
                } else {
                    var comment = JSON.parse(data);
                    $('#post-comment').val(comment['content']);
                }
            }
        });

        $('#posts-id').val(postsId);
        $('#post-show').attr("src", filePath);
        $('#myModal').modal();
    });
});