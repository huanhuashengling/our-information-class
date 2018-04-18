$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    
    $("[name='likeCheckBox']").bootstrapSwitch({
        onText: '喜欢',
        offText: '不喜欢',
        onColor: 'danger',
        offColor: 'default',
    });
    // $("#is-init").val("true");
    $("[name='likeCheckBox']").on('switchChange.bootstrapSwitch', function (e, data) {
        // console.log("change state event init value "+$("#is-init").val() +" data "+data);
        // var $el = $(data.el)
        // , value = data.value;
        // console.log("init" + $("#is-init").val());
        if ("true" == $("#is-init").val()) {
            var currentMarkNum = parseInt($("#mark-num").val());
            // console.log(e, data, currentMarkNum);

            var markNum = 0;
            $.ajax({
                type: "POST",
                url: '/student/updateMarkState',
                data: {postsId: $("#posts-id").val(), stateCode:((true == data)?1:0)},
                success: function( returnData ) {
                    // console.log(data);
                    if ("false" == returnData) {

                    } else {
                        if (true == data) {
                            markNum = currentMarkNum+1;
                        } else {
                            markNum = (0 == currentMarkNum)?0:(currentMarkNum-1);
                        }
                        $("#mark-num").val(markNum);
                        $("[name='likeCheckBox']").siblings(".bootstrap-switch-label").text(markNum);
                    }
                }
            });
        }
        $("#is-init").val("true");
    });

    $('.thumb-img').on('click', function (e) {
        e.preventDefault();
        // $("[name='likeCheckBox']").bootstrapSwitch('state', "false");
        if ($(".rate-btn").hasClass('active')) {
          setTimeout(function() {
            $(".rate-btn").removeClass('active').find('input').prop('checked', false);
          }.bind(this), 10);
        }
        $('#classmate-post-comment').val("");
        // console.log($(this).attr("value"));
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
            url: '/student/getMarkNumByPostsId',
            data: {postsId: postsId},
            success: function( data ) {
                $("[name='likeCheckBox']").siblings(".bootstrap-switch-label").text(data);
                $("#mark-num").val(data);
            }
        });

        $.ajax({
            type: "POST",
            url: '/student/getIsMarkedByMyself',
            data: {postsId: postsId},
            success: function( data ) {
                // console.log("getIsMarkedByMyself " + data);

                if ("true" == data) {
                    $("#is-init").val("false");
                    // $("#is-marked-by-myself").val(data);
                    $("[name='likeCheckBox']").bootstrapSwitch('state', true);
                    // $("[name='likeCheckBox']").prop('checked', true);
                } else {
                    $("[name='likeCheckBox']").bootstrapSwitch('state', false);
                }
                
            }
        });

        $.ajax({
            type: "POST",
            url: '/student/getOnePost',
            data: {posts_id: postsId},
            success: function( data ) {
                // console.log(data);
                if ("false" == data) {

                } else {
                    $('#classmate-post-show').attr("src", data.storage_name);
                    $("#classmate-post-modal-label").html(data.username+" 同学在 "+data.lessontitle+"<small>"+data.lessonsubtitle+"</small> 课上提交的作品");
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
});