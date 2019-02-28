$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	// $(".school-btn").click(function(e) {
	// 	$('#school-list').bootstrapTable('destroy');
	// 	// console.log($(this).val());
	// 	var schoolsId = $(this).val();
 //        $("#add-new-btn").removeClass("hidden");
 //        $("#add-new-btn").val(schoolsId);

		$('#school-list').bootstrapTable({
	        method: 'post', 
	        search: "true",
	        url: "/district/getSchoolsAccountData",
	        pagination:"true",
	        pageList: [10, 25, 50], 
	        pageSize: 10,
	        pageNumber: 1,
	        toolbar:"#toolbar",
        	queryParams: function(params) {
        		var temp = { 
			        districts_id : 1,//districtsId
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
	// });

    $("#add-new-btn").click(function(e) {
        // alert($(this).val());
        $("#add-new-school-modal").modal("show");
    });

    $("#confirm-add-new-btn").click(function(e) {
        if("" == $("#school-name").val())
        {
            alert("姓名不能为空！");
            return;
        }
        data = {
            'username' : $("#school-name").val(),
            'email' : $("#email").val(),
            'password' : "123456",
            'schools_id' : $("#add-new-btn").val(),
        }
        $.ajax({
            type: "post",
            url: '/district/createOneSchoolAccount',
            data: data,
            success: function( data ) {
                $("#add-new-school-modal").modal("hide");
                $('#school-list').bootstrapTable('refresh');
            }
        });
        // console.log($("#school-name").val());
        // console.log($("#gender").val());
        // console.log($("#add-new-btn").val());
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

function schoolAccountActionCol(value, row, index) {
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
            url: '/district/resetStudentPassword',
            data: {users_id: row.schoolsId},
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

window.schoolAccountActionEvents = {
    'click .lock': function(e, value, row, index) {
        // console.log(row);
        $.ajax({
            type: "POST",
            url: '/district/lockOneStudentAccount',
            data: {users_id: row.schoolsId},
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
            url: '/district/unlockOneStudentAccount',
            data: {users_id: row.schoolsId},
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
        console.log("click edit schools id "+row.schoolsId);
    },
    'click .del': function(e, value, row, index) {
        console.log("click delete schools id "+row.schoolsId);
    },
}
