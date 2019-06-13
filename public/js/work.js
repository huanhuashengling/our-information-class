$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    reloadWorkCommentList($("#works-id").val());
	$("#submit-comment-btn").click(function(){
        if ("" == $("#comment-content").val()) {
            alert("建议内容不能为空！");
            return;
        }
        if (10 > $("#comment-content").val().length) {
            alert("建议内容少于10个字！");
            return;
        }
        if (255 < $("#comment-content").val().length) {
            alert("建议内容太长！");
            return;
        }
		$.ajax({
            type: "POST",
            url: '/add-work-comment',
            data: {content: $("#comment-content").val(),
            		 guest_students_id: $("#guest-students-id").val(),
            		 works_id: $("#works-id").val(),
            		 students_id: $("#students-id").val(),
            		},
            success: function( data ) {
                if("true" == data) {
                	alert("建议提交成功！");
                    $("#comment-content").val("");
                	reloadWorkCommentList($("#works-id").val());
                } else if("unable" == data) {
                    alert("你已经被禁言，不能再发表任何建议了！");
                } else {
                	alert("建议提交失败！");
                }
            }
        });
	});

	$("#refresh-comments-btn").click(function(){
		reloadWorkCommentList($("#works-id").val(), $("#guest-students-id").val());
	});
});

function reloadWorkCommentList(worksId) {
	$.ajax({
        type: "POST",
        url: '/list-work-comment',
        data: {works_id: worksId},
        success: function( data ) {
        	// console.log(data);
        	$("#comment-list").html(data);
        }
    });
}