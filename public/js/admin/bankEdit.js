/**
 * Created by Administrator on 2017/12/4.
 */
    function uploadPic(a,inputId){
        var id = 'id_' + inputId;
        var file = 'file_' + inputId;
        $.ajaxFileUpload({
            url:url,
            type:"post",
            fileElementId:file,
            dataType:'json',
            // Form数据
            data:{file_name:file,'_token':_token},
            success:function(data){
                console.log(data);
                if(data.status){
                    console.log(ossImgUrl + data.file_name);
                    console.log(id);
                    $('#'+inputId).val(data.file_name);
                    $('#'+id).attr('src', ossImgUrl + data.file_name);
                }else{
                    alert(data.msg);
                }
            }
        });
    }

/*

    $('#backIconBtn').click(function(){
        $.ajaxFileUpload({
            url:url,
            type:"post",
            fileElementId:"bankIcon",
            dataType: 'json',
            // Form数据
            data:{file_name:"bankIcon",'_token':_token},
            success:function(data, status){
                if (data.status) {
                    console.log(data);
                    $('#bankIcon').val(data.file_name);
                    $('#iconImg').attr('src', ossImgUrl + data.file_name);
                }
                console.log(data);
            }
        });
    });

    $('#bankLimitBtn').click(function(){
        $.ajaxFileUpload({
            url:url,
            type:"post",
            fileElementId:"bankLimitBg",
            dataType: 'json',
            // Form数据
            data:{file_name:"bankLimitBg",'_token':_token},
            success:function(result, status){
                if (data.status == 1) {
                    $('#bankLimitBg').val(data.file_name);
                    $('#bankLimitImg').attr('src', ossImgUrl + data.file_name);
                } else {
                    console.log(data);
                }
            }
        });
    });


    $('#bankNormalBtn').click(function(){
        $.ajaxFileUpload({
            url:url,
            type:"post",
            fileElementId:"bankNormalBg",
            dataType: 'json',
            // Form数据
            data:{file_name:"bankNormalBg",'_token':_token},
            success:function(result, status){
                if (data.status == 1) {
                    $('#bankNormalBg').val(data.file_name);
                    $('#bankNormalImg').attr('src', ossImgUrl + data.file_name);
                } else {
                    console.log(data);
                }
            }
        });
    });
*/


