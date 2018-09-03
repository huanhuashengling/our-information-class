$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$('#course-list').bootstrapTable({
        method: 'get', 
        search: "true",
        url: "/teacher/get-course-list",
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

    $("#add-course-btn").click(function(e) {
    	window.location.href = "/teacher/course/create";
    });
});

function classTitleCol(value, row, index) {
    return [
        "<span>" + row["enter_school_year"] + "级" + row["class_title"] + '班</span>'
    ].join('');
}

function actionCol(value, row, index) {
    return [
        ' <a class="btn btn-warning btn-sm edit">编辑</a>',
        ' <a class="btn btn-danger btn-sm del">删除</a>'
    ].join('');
}

window.actionEvents = {
	'click .edit': function(e, value, row, index) {
		window.location.href = "/teacher/course/"+row.id+"/edit";
    },
    'click .del': function(e, value, row, index) {
    	alert("目前不能删除！！");
    	/*if(row.lesson_log_num > 0) {
    		alert("上课纪录大于1，不能删除！！");
    	} else {
	    	if (confirm("确认删除当前的课程吗？")==true) {
		        $.ajax({
		            type: "POST",
		            url: '/teacher/deleteLesson',
		            data: {lessonsId: row.id},
		            success: function( data ) {
		                // console.log(data);
		            	if ("true" == data) {
		            		alert("课程删除成功！");
		            	} else {
		            		alert("课程删除失败！");
		            	}
		                // $("#no-post-report").html(data);
		                $('#lesson-list').bootstrapTable("refresh");
		            }
		        });
		  	}
    	}*/
		
    },
}