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
                    type: "POST",
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
                    type: "POST",
                    url: '/teacher/getCommentByPostsId',
                    data: {posts_id : postsId},
                    success: function( data ) {
                        console.log(data);
                        var conmmentStr = "暂无评论";
                        if ("false" != data) {
                            conmmentStr = JSON.parse(data)['content'];
                        }
                        $('#post-comment-'+postsId).val(conmmentStr);
                    }
                });

                $('#posts-id').val(postsId);
                // $('#post-show-'+postsId).attr("src", filePath);
                $('#post-show-'+postsId).attr("href", filePath);
                //$('#myModal').modal();
            }
            
        });

       $(".input-zh").fileinput({
            language: "zh", 
            // uploadUrl: "student/upload", 
            // allowedFileExtensions: ["jpg", "png", "gif"], 
            // uploadAsync: true
            initialPreview: [
            $("#posted-path").val(),
            // "/storage/20171113053053--5a092e0d0b106.png",
            // "https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1510572057&di=81996b519f149515af45bb02a8e95a00&src=http://imgsrc.baidu.com/imgad/pic/item/b21c8701a18b87d6232299000d0828381f30fd48.jpg"
                // $("#posted-path").text(),
                //"<img src='" + $("#posted-path").text() + "' class='file-preview-image  kv-preview-data' >",
            ],
            initialPreviewAsData: true, // 特别重要
    });
});