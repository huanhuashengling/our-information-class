$(document).ready(function() {
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	$('#send-mail-list').bootstrapTable({
        method: 'get', 
        search: "true",
        url: "/school/get-send-mail-list",
        pagination:"true",
        pageList: [20, 40], 
        pageSize:40,
        pageNumber: 1,
        toolbar:"#toolbar",
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

    $("#add-send-mail-btn").click(function() {
    	$("#add-send-mail-modal").modal("show");
    });

    $("#add-send-mail").click(function() {
    	var data = {'serverProvider' : $("#server-provider").val(), 
    				'numLimitOneDay' : $("#num-limit-one-day").val(), 
    				'username' : $("#username").val(), 
    				'mailAddress' : $("#mail-address").val(), 
    				'password' : $("#password").val(), 
    				'authCode' : $("#auth-code").val(), 
    				'isUseable' : $("#is-useable").val()};
    	$.ajax({
            type: "POST",
            url: '/school/addSendMail',
            data: data,
            success: function( data ) {
                if("true" == data) {
                	$("#add-send-mail-modal").modal("hide");
                	$('#send-mail-list').bootstrapTable("refresh");
                }
            }
        });
    });

    $("#edit-send-mail").click(function() {
        var data = {'serverProvider' : $("#edit-server-provider").val(), 
                    'numLimitOneDay' : $("#edit-num-limit-one-day").val(), 
                    'username' : $("#edit-username").val(), 
                    'mailAddress' : $("#edit-mail-address").val(), 
                    'password' : $("#edit-password").val(), 
                    'authCode' : $("#edit-auth-code").val(), 
                    'isUseable' : $("#edit-is-useable").val(),
                    'id' : $("#send-mail-id").val()};
        $.ajax({
            type: "POST",
            url: '/school/updateSendMail',
            data: data,
            success: function( data ) {
                if("true" == data) {
                    $("#edit-send-mail-modal").modal("hide");
                    $('#send-mail-list').bootstrapTable("refresh");
                }
            }
        });
    });
});

function actionCol(value, row, index) {
    return [
        ' <a class="btn btn-danger btn-sm inactive">停用</a>',
        ' <a class="btn btn-info btn-sm edit">编辑</a>'
    ].join('');
}

window.actionEvents = {
    'click .edit': function(e, value, row, index) {
        // console.log(row);
        $("#edit-username").val(row.username);
        $("#edit-mail-address").val(row.mail_address);
        $("#edit-password").val(row.password);
        $("#edit-auth-code").val(row.auth_code);
        $("#send-mail-id").val(row.id);
        $("#edit-send-mail-modal").modal("show");
    },
}