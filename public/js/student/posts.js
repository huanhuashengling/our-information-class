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

    $("#term-selection").change(function(e){
        refreshPostList();
    })
    refreshPostList();
    $(document)
	   .on('click', '.panel-title', function (e) {
            if ($(this).attr("value")) {

                // $.ajax({
                //     type: "POST",
                //     url: '/student/getOnePost',
                //     data: {posts_id: postsId},
                //     success: function( data ) {
                //         // console.log(data);
                //         if ("false" == data) {

                //         } else {
                //             if ("doc" == data.filetype) {
                //                 $('#doc-preview').html(OnCreateUrl(data.storage_name));
                //             } else if ("img" == data.filetype) {
                //                 $('#classmate-post-show').attr("src", data.storage_name);
                //             }
                //             // $('#classmate-post-show').attr("src", data.storage_name);
                //             $("#classmate-post-modal-label").html(data.username+" 同学在 "+data.lessontitle+"<small>"+data.lessonsubtitle+"</small> 课上提交的作品");
                //         }
                //     }
                // });
                
                var postsId = $(this).attr("value").split(',')[0]; 
                var filePath = $(this).attr("value").split(',')[1]; 
                var filetype = $(this).attr("value").split(',')[2]; 
                var previewPath = $(this).attr("value").split(',')[3]; 

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '/student/getPostRate',
                    data: {posts_id : postsId},
                    success: function( data ) {
                        //console.log(data);
                        var rateStr = "暂无等第";
                        if ("false" != data) {
                           rateStr = "等第：" + data;
                        }
                        $('#rate-label-'+postsId).text(rateStr);
                    }
                });

                $.ajax({
                    type: "POST",
                    url: '/student/getCommentByPostsId',
                    data: {posts_id : postsId},
                    success: function( data ) {
                        var conmmentStr = "暂无评语";
                        if ("false" != data) {
                            conmmentStr = "老师评语：" + JSON.parse(data)['content'];
                        // console.log(JSON.parse(data));
                        }
                        $('#post-comment-'+postsId).text(conmmentStr);
                    }
                });

                $('#posts-id').val(postsId);
                if ("doc" == filetype) {
                    // console.log(OnCreateUrl(previewPath));
                    // console.log((previewPath));
                    $('#doc-preview-'+postsId).html(OnCreateUrl(previewPath));
                } else if ("img" == filetype) {
                    $('#post-show-'+postsId).attr("src", filePath);
                }
                // $('#post-show-'+postsId).attr("src", filePath);
                $('#post-download-'+postsId).attr("href", filePath);
                // $('#post-show-'+postsId).attr("href", filePath);
                //$('#myModal').modal();
            }
            
        });
        // $(".input-zh").each(function() {
        //     console.log($(this).attr("id"));
        //     var postsId = $(this).attr("id").split("-")[2];
        //     if (postsId) {
        //         $(this).fileinput({
        //             language: "zh", 
        //             // uploadUrl: "student/upload", 
        //             allowedFileExtensions: ["jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html"], 
        //             // uploadAsync: true
        //             // overwriteInitial: true,
        //             initialPreview: [
        //                 $("#posted-path-"+postsId).val(),
        //             ],
        //             initialPreviewAsData: true, // 特别重要
        //         });
        //     } else {
        //         $(this).fileinput({
        //             language: "zh", 
        //             allowedFileExtensions: ["jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html"], 
        //             initialPreviewAsData: true, // 特别重要
        //         });
        //     }
        // })
});

function refreshPostList() {
    // alert($("#term-selection").val());
    $.ajax({
        type: "POST",
        url: '/student/getPostsByTerm',
        data: {termsId : $("#term-selection").val()},
        success: function( data ) {
            $("#posts-list").html(data);
            // console.log(data);
            $(".input-zh").each(function() {
                // console.log($(this).attr("id"));
                var postsId = $(this).attr("id").split("-")[2];
                if (postsId) {
                    $(this).fileinput({
                        language: "zh", 
                        // uploadUrl: "student/upload", 
                        allowedFileExtensions: ["jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html"], 
                        // uploadAsync: true
                        // overwriteInitial: true,
                        initialPreview: [
                            $("#posted-path-"+postsId).val(),
                        ],
                        initialPreviewAsData: true, // 特别重要
                    });
                } else {
                    $(this).fileinput({
                        language: "zh", 
                        allowedFileExtensions: ["jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html"], 
                        initialPreviewAsData: true, // 特别重要
                    });
                }
            })
        }
    });
}

function OnCreateUrl(data)
{
    // var originalUrl = document.getElementById(OriginalUrlElementId).value;
    var originalUrl = data;

    // var generatedViewUrl = ViewUrlMask.replace(UrlPlaceholder, encodeURIComponent(originalUrl));
    var generatedEmbedCode = EmbedCodeMask.replace(UrlPlaceholder, encodeURIComponent(originalUrl));
    return generatedEmbedCode;
    // document.getElementById(GeneratedViewUrlElementId).value = generatedViewUrl;
    // document.getElementById(GeneratedEmbedCodeElementId).value = generatedEmbedCode;
}