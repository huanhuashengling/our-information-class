var ViewUrlMask = "http:\u002f\u002f10.63.7.189\u002fop\u002fview.aspx?src=WACFILEURL";
var EmbedCodeMask = "\u003ciframe src=\u0027http:\u002f\u002f10.63.7.189\u002fop\u002fembed.aspx?src=WACFILEURL\u0027 width=\u0027800px\u0027 height=\u0027600px\u0027 frameborder=\u00270\u0027\u003eThis is an embedded \u003ca target=\u0027_blank\u0027 href=\u0027http:\u002f\u002foffice.com\u0027\u003eMicrosoft Office\u003c\u002fa\u003e document, powered by \u003ca target=\u0027_blank\u0027 href=\u0027http:\u002f\u002foffice.com\u002fwebapps\u0027\u003eOffice Web Apps\u003c\u002fa\u003e.\u003c\u002fiframe\u003e";
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

	$("#term-selection").change(function(){
		if (0 == $("#term-selection").val()) {
    		$("#lesson-log-selection").html("<option>请选择学期</option>");
    		return;
    	}

        $.ajax({
            type: "POST",
            url: '/teacher/loadSclassSelection',
            data: {terms_id: $("#term-selection").val()},
            success: function( data ) {
                // console.log(data);
                $("#sclasses-selection").html(data);
            }
        });
	});

	$("#sclasses-selection").change(function(){
		if (0 == $("#term-selection").val()) {
    		$("#lesson-log-selection").html("<option>请选择学期</option>");
    		return;
    	}
		if (0 == $("#sclasses-selection").val()) {
    		$("#lesson-log-selection").html("<option>请选择班号</option>");
    		return;
    	}
        // alert($("#term-selection").val());
		// alert($("#sclasses-selection").val());
		$.ajax({
            type: "POST",
            url: '/teacher/loadLessonLogSelection',
            data: {terms_id: $("#term-selection").val(), sclassesId: $("#sclasses-selection").val()},
            success: function( data ) {
            	// console.log(data);
            	$("#lesson-log-selection").html(data);
            }
        });
	});

	$("#lesson-log-selection").change(function(){
		// alert($("#term-selection").val());
		$.ajax({
            type: "POST",
            url: '/teacher/getPostDataByTermAndSclass',
            data: {lessonlogsId: $("#lesson-log-selection").val()},
            success: function( data ) {
            	// console.log(data);
            	$("#posts_area").html(data);
            }
        });
	});

    $(document)
	    .on('click', '#update-rethink', function (e) {
	        // console.log($("#rethink").val());
	        if ("" == $("#rethink").val())
	        {
	            alert("反思没有内容！！");
	            return;
	        }
	        e.preventDefault();
	        $.ajax({
	            type: "POST",
	            url: '/teacher/updateRethink',
	            data: {lessonLogId: $("#lesson-log-id").val(), rethink:$("#rethink").val()},
	            success: function( data ) {
	                if ("true" == data) {
	                    alert('反思更新成功!');
	                } else {
	                    alert('反思更新失败!');
	                }
	            }
	        });
	    })
		.on('click', '.post-btn', function(e) {
	        e.preventDefault();
	        $("div[name='level-btn-group'] label").each(function(){
	            $(this).removeClass("active");
	        });
	        $('#post-comment').val("");
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
                    // console.log(data);
                    // console.log(OnCreateUrl(data));

                    if ("doc" == data.filetype) {
                        $('#post-show').addClass("hidden");
                        $('#doc-preview').removeClass("hidden");
                        $('#flashContent').addClass("hidden");
                        $('#doc-preview').html(OnCreateUrl(data.url));
                    } else if ("img" == data.filetype) {
                        $('#post-show').removeClass("hidden");
                        $('#doc-preview').addClass("hidden");
                        $('#flashContent').addClass("hidden");
                        $('#post-show').attr("src", data.url);
                    } else if ("sb2" == data.filetype) {
                        // alert("sb2");
                        $('#post-show').addClass("hidden");
                        $('#doc-preview').addClass("hidden");
                        $('#flashContent').removeClass("hidden");
                        var tHtml = "<object type='application/x-shockwave-flash' data='/scratch/Scratch.swf' width='850px' height='850px'>\n"+
                                        "<param name='movie' value='/scratch/Scratch.swf'/>\n"+
                                        "<param name='bgcolor' value='#FFFFFF'/>\n"+
                                        "<param name='FlashVars' value='project=" + data.url + "&autostart=false' />\n"+
                                        "<param name='allowscriptaccess' value='always'/>\n"+
                                        "<param name='allowFullScreen' value='true'/>\n"+
                                        "<param name='wmode' value='direct'/>\n"+
                                        "<param name='menu' value='false'/>\n"+
                                    "</object>";
                        $('#flashContent').html(tHtml);
                        // showScratch(data.url);
                        // showScratch(data.url);
                    }
                    // $('#doc-preview').attr("src", "http://lessons_id/op/embed.aspx?src=" + data);
                    $('#post-download-link').attr("href", data["url"]);

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