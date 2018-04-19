$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $("#import-student-account").fileinput({
		showPreview: false,
		language: "zh", 
		allowedFileExtensions: ["xls", "xlsx", "csv"],
	});

	$(".sclass-btn").click(function(e) {
		$('#student-list').bootstrapTable('destroy');
		// console.log($(this).val());
		var sclassesId = $(this).val();

		$('#student-list').bootstrapTable({
	        method: 'post', 
	        search: "true",
	        url: "/admin/getStudentsData",
	        pagination:"true",
	        pageList: [10, 25, 50], 
	        pageSize: 10,
	        pageNumber: 1,
	        toolbar:"#toolbar",
        	queryParams: function(params) {
        		var temp = { 
			        sclasses_id : sclassesId
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
});

function genderCol(value, row, index) {
    return [
        '<span>'+(("0" == value)?"女":"男")+'</span>'
    ].join('');
}

function classTitleCol(value, row, index) {
    return [
        "<span>" + row["enter_school_year"] + "级" + row["class_title"] + '班</span>'
    ].join('');
}

function resetCol(value, row, index) {
    return [
        '<a class="btn btn-info btn-sm reset" data-unique-id="', row.users_id, '">重置</a>'
    ].join('');
}

function actionCol(value, row, index) {
    var lockStr = "锁定";
    var lockClass = "lock";
    if (1 == row.is_lock)
    {
        lockStr = "解锁";
        lockClass = "unlock";
    }
    return [
        '<a class="btn btn-warning btn-sm '+ lockClass+'">'+lockStr+'</a> ',
        ' <a class="btn btn-danger btn-sm edit">编辑</a> ',
        ' <a class="btn btn-danger btn-sm del">删除</a>'
    ].join('');
}

window.resetActionEvents = {
	'click .reset': function(e, value, row, index) {
     	$.ajax({
            type: "POST",
            url: '/admin/resetStudentPassword',
            data: {users_id: row.studentsId},
            success: function( data ) {
            	if("true" == data) {
            		alert("重置密码成功，已修改为默认密码123456！")
            	} else if ("false" == data) {
            		alert("重置密码失败，没有找到该用户！")
            	}
            }
        });
    },
}

window.actionEvents = {
    'click .lock': function(e, value, row, index) {
        // console.log(row);
        $.ajax({
            type: "POST",
            url: '/admin/lockOneStudentAccount',
            data: {users_id: row.studentsId},
            success: function( data ) {
                if("true" == data) {
                    alert(row.username+"已被锁定！")
                } else if ("false" == data) {
                    alert("锁定失败！")
                }
            }
        });
    },
    'click .unlock': function(e, value, row, index) {
        // console.log(row);
        $.ajax({
            type: "POST",
            url: '/admin/unlockOneStudentAccount',
            data: {users_id: row.studentsId},
            success: function( data ) {
                if("true" == data) {
                    alert(row.username+"解锁成功！")
                } else if ("false" == data) {
                    alert("解锁失败！")
                }
            }
        });
    },
    'click .edit': function(e, value, row, index) {
        console.log("click edit students id "+row.studentsId);
    },
    'click .del': function(e, value, row, index) {
        console.log("click delete students id "+row.studentsId);
    },
}
