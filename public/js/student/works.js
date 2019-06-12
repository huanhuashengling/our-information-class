$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$('#work-list').bootstrapTable({
        method: 'get', 
        search: "true",
        url: "/student/get-work-list",
        pagination:"true",
        pageList: [15, 30], 
        pageSize:15,
        pageNumber: 1,
        toolbar:"#toolbar",
    	// queryParams: function(params) {
    	// 	var temp = { 
		   //      coursesId : $("#course-selection").val(),
		   //  };
		   //  return temp;
    	// },
    	// clickToSelect: true,
    	columns: [{  
                    checkbox: true  
                },{  
                    title: '序号',
                    formatter: function (value, row, index) {  
                        return index+1;  
                    }  
                }],
        responseHandler: function (res) {
        	// console.log(res);
            return res;
        },
    });

    $("#add-work-btn").click(function(e) {
    	window.location.href = "/student/work/create";
    });


    $("#cover-upload").fileinput({
        language: "zh", 
        uploadUrl: "/student/upload-cover", 
        allowedFileExtensions: ["jpg", "png", "bmp"], 
        maxImageWidth: 100,
        maxImageHeight: 100,
        resizePreference: 'height',
        resizeImage: true,
        resizeIfSizeMoreThan: 100,
        dropZoneTitle: "选择上传作品封面,（注意：新提交会将旧的替换！）",
        // showPreview: "false",
        msgPlaceholder: "选择上传作品封面 ...",
        initialPreviewShowDelete: false,
        initialPreviewAsData: true, // 特别重要
        uploadExtraData:function(){
            return {'worksId' : $("#works-id").val()};
        }
    });

    $("#work-upload").fileinput({
        language: "zh", 
        uploadUrl: "/student/upload-work", 
        allowedFileExtensions: ["jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html", "sb2"], 
        // uploadAsync: true
        // overwriteInitial: true,
        // initialPreview: [
        //  $("#posted-path").val(),
     //    ],
        dropZoneTitle: "选择上传作品, （注意：新提交会将旧的替换！）",
        // showPreview: "false",
        msgPlaceholder: "选择上传作品 ...",
        // initialPreviewConfig: [
        //  {type: "gdocs", size: 1002400, caption: $("#file_name").val()},
        // ],
        initialPreviewShowDelete: false,
        initialPreviewAsData: true, // 特别重要
        uploadExtraData:function(){
            return {'worksId' : $("#works-id").val()};
        }
    });


});

function ideaCol(value, row, index) {
    return [
        "<span>" + ((row["work_idea"].length >100)?row["work_idea"].substring(0,99):html_encode(row["work_idea"])) + '</span>'
    ].join('');
}

function descCol(value, row, index) {
    return [
        "<span>" + ((row["description"].length >100)?row["description"].substring(0,99):html_encode(row["description"])) + '</span>'
    ].join('');
}

function coverCol(value, row, index) {
    return [
        ' <a class="btn btn-info btn-sm upload-cover">上传封面</a>',
    ].join('');
}

function openCol(value, row, index) {
    return [
        "<span>" + ((row["is_open"] == 1)?"是":"否") + '</span>'
    ].join('');
}

function workCol(value, row, index) {
    return [
        ' <a class="btn btn-info btn-sm upload-work" id="work-btn">上传作品a</a>',
    ].join('');
}

function actionCol(value, row, index) {
    var isHidden = "hidden";
    if (row.work_name) {
        isHidden = "";
    }
    return [
        ' <a class="btn btn-primary btn-sm edit">编辑作品信息</a>',
        ' <a class="btn btn-success btn-sm upload-cover">上传封面</a>',
        ' <a class="btn btn-info btn-sm ' + isHidden + '"  href="' +$("#prefix").val()+ row.work_name+ '" id="download-btn">下载作品</a>',
        ' <a class="btn btn-info btn-sm upload-work" id="work-btn">上传作品</a>',
    ].join('');
}


function html_encode(str){   
  var s = "";   
    if (str.length == 0) return "";   
    s = str.replace(/&/g, ">");   
    s = s.replace(/</g, "<");   
    s = s.replace(/>/g, ">");   
    s = s.replace(/ /g, " ");   
    s = s.replace(/\'/g, "'");   
    s = s.replace(/\"/g, '"');
    s = s.replace(/\n/g, "<br>");   
    // s = eval("'" +s+ "'");  
    return s;   
}

// window.coverEvents = {
//     'click .upload-cover': function(e, value, row, index) {
//         e.preventDefault();
//         $("#cover-upload-modal").modal();
//     },
//     'click .upload-work': function(e, value, row, index) {
//         e.preventDefault();
//         alert("asasas");
//         $("#cover-upload-modal").modal();
//     },
//     'click #work-btn': function(e, value, row, index) {
//         e.preventDefault();
//         alert("asasas");
//         $("#cover-upload-modal").modal();
//     },
// }

// window.workEvents = {
//     'click .upload-work': function(e, value, row, index) {
//         e.preventDefault();
//         alert("asasas");
//         $("#cover-upload-modal").modal();
//     },
//     'click #work-btn': function(e, value, row, index) {
//         e.preventDefault();
//         alert("asasas");
//         $("#cover-upload-modal").modal();
//     },
// }

window.actionEvents = {
    'click .upload-cover': function(e, value, row, index) {
        e.preventDefault();
        $("#works-id").val(row.id);
        $("#cover-upload-modal").modal();
    },
    'click .upload-work': function(e, value, row, index) {
        e.preventDefault();
        $("#works-id").val(row.id);
        $("#work-upload-modal").modal();
    },
	'click .edit': function(e, value, row, index) {
		window.location.href = "/student/work/"+row.id+"/edit";
    },
}