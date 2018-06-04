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
    $(document)
	   .on('click', '.panel-title', function (e) {
            if ($(this).attr("value")) {
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
                    console.log(OnCreateUrl(previewPath));
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

       $(".input-zh").fileinput({
            language: "zh", 
            // uploadUrl: "student/upload", 
            allowedFileExtensions: ["jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html"], 
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