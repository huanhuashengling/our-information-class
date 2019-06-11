$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$('#lesson-list').bootstrapTable({
        method: 'get', 
        search: "true",
        url: "/teacher/get-lesson-list",
        pagination:"true",
        pageList: [15, 30], 
        pageSize:15,
        pageNumber: 1,
        toolbar:"#toolbar",
    	// queryParams: function(params) {
    	// 	var temp = { 
		   //      lessonsId : $("#lesson-selection").val(),
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

    $("#add-lesson-btn").click(function(e) {
    	window.location.href = "/teacher/lesson/create";
    });
});

function subtitleCol(value, row, index) {
    var str = (15 < value.length)?(value.substring(0,15)+"..."):value;
    return [
        "<span>" + str + '</span>'
    ].join('');
}

function isOpenCol(value, row, index) {
    var str = (1 == value)?"开放":"未开放";
    return [
        "<span>" + str + "</span>"
    ].join('');
}

function actionCol(value, row, index) {
    var lockStr = "关闭";
    var lockClass = "closeLesson";
    if (2 == row.is_open)
    {
        lockStr = "开放";
        lockClass = "openLesson";
    }
    return [
        ' <a class="btn btn-info btn-sm ' + lockClass + '">' + lockStr + '</a>',
        ' <a class="btn btn-info btn-sm detail">查看</a>',
        ' <a class="btn btn-warning btn-sm edit">编辑</a>',
        ' <a class="btn btn-danger btn-sm del">删除</a>'
    ].join('');
}

window.actionEvents = {
	'click .detail': function(e, value, row, index) {
		$.ajax({
            type: "POST",
            url: '/teacher/getLesson',
            data: {lessonsId: row.id},
            success: function( data ) {
                // console.log(data);
                $("#lesson-detail-title").html("课题：" + data.title + " <small>" + data.subtitle + "</small>");
                $("#lesson-detail-help-md-doc").html(data.help_md_doc);
				$("#lesson-detail-modal").modal("show");
            }
        });
    },
	'click .edit': function(e, value, row, index) {
		window.location.href = "/teacher/lesson/"+row.id+"/edit";
    },
    'click .closeLesson': function(e, value, row, index) {
        // console.log(row);
        $.ajax({
            type: "POST",
            url: '/teacher/closeLesson',
            data: {lessons_id: row.id},
            success: function( data ) {
                if("true" == data) {
                    alert(row.title+" 课已被关闭！")
                } else if ("false" == data) {
                    alert("关闭课失败！")
                }
            }
        });
        $('#lesson-list').bootstrapTable("refresh");
    },
    'click .openLesson': function(e, value, row, index) {
        // console.log(row);
        $.ajax({
            type: "POST",
            url: '/teacher/openLesson',
            data: {lessons_id: row.id},
            success: function( data ) {
                if("true" == data) {
                    alert(row.title+" 课已被开放！")
                } else if ("false" == data) {
                    alert("开放课失败！")
                }
            }
        });
        $('#lesson-list').bootstrapTable("refresh");
    },
    'click .del': function(e, value, row, index) {
    	if(row.lesson_log_num > 0) {
    		alert("上课纪录大于1，不能删除！！");
    	} else {
	    	if (confirm("确认删除当前的课吗？")==true) {
		        $.ajax({
		            type: "POST",
		            url: '/teacher/deleteLesson',
		            data: {lessonsId: row.id},
		            success: function( data ) {
		                // console.log(data);
		            	if ("true" == data) {
		            		alert("课删除成功！");
		            	} else {
		            		alert("课删除失败！");
		            	}
		                // $("#no-post-report").html(data);
		                $('#lesson-list').bootstrapTable("refresh");
		            }
		        });
		  	}
    	}
		
    },
}