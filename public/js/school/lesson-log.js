$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$('#lesson-log-list').bootstrapTable({
        method: 'post', 
        search: "true",
        url: "/school/get-lesson-log-list",
        pagination:"true",
        pageList: [15, 30], 
        pageSize:15,
        pageNumber: 1,
        toolbar:"#toolbar",
    	queryParams: function(params) {
    		var temp = { 
		        lessonlogsId : $("#lesson-log-selection").val(),
		    };
		    return temp;
    	},
    	clickToSelect: true,
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
});

function classTitleCol(value, row, index) {
    return [
        "<span>" + row["enter_school_year"] + "级" + row["class_title"] + '班</span>'
    ].join('');
}

function actionCol(value, row, index) {
    return [
        ' <a class="btn btn-danger btn-sm del">删除</a>'
    ].join('');
}

window.actionEvents = {
    'click .del': function(e, value, row, index) {
    	if(row.post_num > 10) {
    		alert("提交作业数大于10，不能删除！！");
    	} else {
	    	if (confirm("确认删除当前的上课记录吗？")==true) {
		        $.ajax({
		            type: "POST",
		            url: '/school/delLessonLog',
		            data: {lessonLogsId: row.id},
		            success: function( data ) {
		                // console.log(data);
		            	if ("" == data) {
		            		alert("上课纪录删除成功！");
		            	} else {
		            		alert(data);
		            	}
		                // $("#no-post-report").html(data);
		                $('#lesson-log-list').bootstrapTable("refresh");
		            }
		        });
		  	}
    	}
		
    },
}