$(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#unit-list').bootstrapTable({
        method: 'get', 
        search: "true",
        url: "/teacher/get-unit-list",
        pagination:"true",
        pageList: [15, 30], 
        pageSize:15,
        pageNumber: 1,
        toolbar:"#toolbar",
        queryParams: function(params) {
         var temp = { 
                coursesId : $("#courses-id").val(),
            };
            return temp;
        },
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

    $("#add-unit-btn").click(function(e) {
        window.location.href = "/teacher/unit/create";
    });
});

function descCol(value, row, index) {
    var str = (25 < value.length)?(value.substring(0,25)+"..."):value;
    return [
        "<span>" + str + '</span>'
    ].join('');
}

function isOpenCol(value, row, index) {
    var str = (1 == value)?"是":"-";
    return [
        "<span>" + str + "</span>"
    ].join('');
}

function actionCol(value, row, index) {
    var lockStr = "关闭";
    var lockClass = "closeUnit";
    if (2 == row.is_open)
    {
        lockStr = "开放";
        lockClass = "openUnit";
    }
    return [
        ' <a class="btn btn-info btn-sm ' + lockClass + '">' + lockStr + '</a>',
        ' <a class="btn btn-warning btn-sm edit">编辑</a>',
        ' <a class="btn btn-danger btn-sm del">删除</a>',
        ' <a class="btn btn-success btn-sm lesson">课列表</a>'
    ].join('');
}

window.actionEvents = {
    'click .edit': function(e, value, row, index) {
        window.location.href = "/teacher/unit/"+row.id+"/edit";
    },
    'click .closeUnit': function(e, value, row, index) {
        // console.log(row);
        $.ajax({
            type: "POST",
            url: '/teacher/closeUnit',
            data: {units_id: row.id},
            success: function( data ) {
                if("true" == data) {
                    alert(row.title+" 单元已被关闭！")
                } else if ("false" == data) {
                    alert("关闭单元失败！")
                }
            }
        });
        $('#unit-list').bootstrapTable("refresh");
    },
    'click .openUnit': function(e, value, row, index) {
        // console.log(row);
        $.ajax({
            type: "POST",
            url: '/teacher/openUnit',
            data: {units_id: row.id},
            success: function( data ) {
                if("true" == data) {
                    alert(row.title+" 单元已被开放！")
                } else if ("false" == data) {
                    alert("开放单元失败！")
                }
            }
        });
        $('#unit-list').bootstrapTable("refresh");
    },
    'click .lesson': function(e, value, row, index) {
        // console.log(row);
        window.location.href = "/teacher/lesson?uId="+row.id;
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