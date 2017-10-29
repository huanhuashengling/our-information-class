$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $(document)
	   .on('click', '.panel-title', function (e) {
            if ($(this).attr("value")) {
                var postsId = $(this).attr("value").split(',')[0]; 
                var filePath = $(this).attr("value").split(',')[1]; 

                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: '/teacher/getPostRate',
                    data: {posts_id : postsId},
                    success: function( data ) {
                        // console.log(data);
                        var rateStr = "暂未评等第";
                        if ("outstanding" == data) {
                            rateStr = "本次作业：优秀";
                        } else if ("good" == data) {
                            rateStr = "本次作业：良好";
                        } else if ("lower" == data) {
                            rateStr = "本次作业：合格";
                        }
                        $('#rate-label-'+postsId).text(rateStr);
                    }
                });

                $.ajax({
                    type: "GET",
                    url: '/teacher/getCommentByPostsId',
                    data: {posts_id : postsId},
                    success: function( data ) {
                        // console.log(data);
                        var conmmentStr = "暂无评论";
                        if ("false" != data) {
                            conmmentStr = JSON.parse(data)['content'];
                        }
                        $('#post-comment-'+postsId).val(conmmentStr);
                    }
                });

                $('#posts-id').val(postsId);
                $('#post-show-'+postsId).attr("src", filePath);
                //$('#myModal').modal();
            }
            
        });
});