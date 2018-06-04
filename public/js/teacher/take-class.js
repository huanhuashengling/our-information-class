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

    

    $('#close-lesson-log').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/teacher/updateLessonLog',
            data: {lessonLogId: $("#lesson-log-id").val(), action: "close-lesson-log"},
            success: function( data ) {
            	// alert(data);
                if ("true" == data) {
                	window.location.href = "/teacher";
                } else {
                	alert('关闭失败!');
                }
            }
        });
    });

    $('.post-btn').on('click', function (e) {
        e.preventDefault();
        $("div[name='level-btn-group'] label").each(function(){
            $(this).removeClass("active");
        });
        // if ($(".rate-btn").hasClass('active')) {
        //   setTimeout(function() {
        //     $(".rate-btn").removeClass('active').find('input').prop('checked', false);
        //   }.bind(this), 10);
        // }
        $('#post-comment').val("");
        // console.log($(this).attr("value"));
        // var postsId = (e.target.value).split(',')[0]; 
        var postsId = $(this).attr("value");
        $('#post-show').attr("src", "");
        $.ajax({
            type: "POST",
            url: '/teacher/getPostRate',
            data: {posts_id: postsId},
            success: function( data ) {
                if ("false" == data) {

                } else {
                    $("div[name='level-btn-group'] label").each(function(){
    // console.log($(this).children().attr("value"));
                    if (data == $(this).children().attr("value")) {
                        $(this).addClass("active");
                        }
                    });
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
                    console.log(data);
                    console.log(OnCreateUrl(data));

                    if ("doc" == data.filetype) {
                        $('#doc-preview').html(OnCreateUrl(data.url));
                    } else if ("img" == data.filetype) {
                        $('#post-show').attr("src", data.url);
                    }
                    // $('#doc-preview').attr("src", "http://mydocview.contoso.com/op/embed.aspx?src=" + data);
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
    });

    $("div[name='level-btn-group'] label").on('click', function (e) {
        var data = {posts_id: $('#posts-id').val(), rate: $(this).children().attr("value")};
        // console.log($(this).children().attr("value"));
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

    $("#add-post-comment-btn").on('click', function (e) {
        var data = {posts_id: $('#posts-id').val(), content: $('#post-comment').val()};
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/teacher/createComment',
            data: data,
            success: function( data ) {
                if ("true" == data) {
                    // window.location.href = "/teacher/takeclass";
                    $('#myModal').modal("hide");

                    // alert('添加评论成功!');
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
                    // window.location.href = "/teacher/takeclass";
                    $('#myModal').modal("hide");

                    // alert('编辑评论成功!');
                } else {
                    alert('编辑评论失败!');
                }
            }
        });
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