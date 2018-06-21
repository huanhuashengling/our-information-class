var ViewUrlMask = "http:\u002f\u002fmydocview.contoso.com\u002fop\u002fview.aspx?src=WACFILEURL";
var EmbedCodeMask = "\u003ciframe src=\u0027http:\u002f\u002fmydocview.contoso.com\u002fop\u002fembed.aspx?src=WACFILEURL\u0027 width=\u0027800px\u0027 height=\u0027600px\u0027 frameborder=\u00270\u0027\u003eThis is an embedded \u003ca target=\u0027_blank\u0027 href=\u0027http:\u002f\u002foffice.com\u0027\u003eMicrosoft Office\u003c\u002fa\u003e document, powered by \u003ca target=\u0027_blank\u0027 href=\u0027http:\u002f\u002foffice.com\u002fwebapps\u0027\u003eOffice Web Apps\u003c\u002fa\u003e.\u003c\u002fiframe\u003e";
var UrlPlaceholder = "WACFILEURL";
var OriginalUrlElementId = "OriginalUrl";
var GeneratedViewUrlElementId = "GeneratedViewUrl";
var GeneratedEmbedCodeElementId = "GeneratedEmbedCode";
var CopyViewUrlLinkId = "CopyViewUrl";
var CopyEmbedCodeLinkId = "CopyEmbedCode";
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

    $('#my-posts-btn').on('click', function (e) {
        top.location='/student/classmate?type=my'; 
    });

    $('#all-posts-btn').on('click', function (e) {
        top.location='/student/classmate?type=all'; 
    });

    $('#same-sclass-posts-btn').on('click', function (e) {
        top.location='/student/classmate?type=same-sclass'; 
    });

    $('#same-grade-posts-btn').on('click', function (e) {
        top.location='/student/classmate?type=same-grade'; 
    });

    $('#my-marked-posts-btn').on('click', function (e) {
        top.location='/student/classmate?type=my-marked'; 
    });

    $('#most-marked-posts-btn').on('click', function (e) {
        top.location='/student/classmate?type=most-marked'; 
    });

    $('#has-comment-posts-btn').on('click', function (e) {
        top.location='/student/classmate?type=has-comment'; 
    });

    $('#name-search-btn').on('click', function (e) {
        if("" == $("#search-name").val()) {
            alert("姓名不能为空！");
        } else {
            top.location='/student/classmate?type=search-name=' + $("#search-name").val(); 
        }
    });

    $('.thumb-img').on('click', function (e) {
        e.preventDefault();
        // $("[name='likeCheckBox']").bootstrapSwitch('state', "false");
        if ($(".rate-btn").hasClass('active')) {
          setTimeout(function() {
            $(".rate-btn").removeClass('active').find('input').prop('checked', false);
          }.bind(this), 10);
        }
        $('#post-comment').val("");
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
                    if ("doc" == data.filetype) {
                        $('#doc-preview').html(OnCreateUrl(data.storage_name));
                    } else if ("img" == data.filetype) {
                        $('#classmate-post-show').attr("src", data.storage_name);
                    }
                    // $('#classmate-post-show').attr("src", data.storage_name);
                    $("#classmate-post-modal-label").html(data.username+" 同学在 "+data.lessontitle+"<small>"+data.lessonsubtitle+"</small> 课上提交的作品");
                }
            }
        });

        $.ajax({
            type: "POST",
            url: '/student/getCommentByPostsId',
            data: {posts_id: postsId},
            success: function( data ) {
                // console.log(data);
                if ("false" == data) {
                    $("#edit-post-comment-btn").addClass("hidden");
                    $("#add-post-comment-btn").removeClass("hidden");
                } else {
                    var comment = JSON.parse(data);
                    $("#edit-post-comment-btn").val(comment['id']);
                    $('#post-comment').text("老师评语：" + comment['content']);
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

function OnCreateUrl(data)
{
    // var originalUrl = document.getElementById(OriginalUrlElementId).value;
    var originalUrl = data;

    var generatedViewUrl = ViewUrlMask.replace(UrlPlaceholder, encodeURIComponent(originalUrl));
    var generatedEmbedCode = EmbedCodeMask.replace(UrlPlaceholder, encodeURIComponent(originalUrl));
    return generatedEmbedCode;
    // document.getElementById(GeneratedViewUrlElementId).value = generatedViewUrl;
    // document.getElementById(GeneratedEmbedCodeElementId).value = generatedEmbedCode;
}