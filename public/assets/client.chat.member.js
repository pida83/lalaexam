var entranceChat = {
    connector: io.connect('http://io.homestead.test:3030/member',{reconnection:false}),
    init : function () {
        this.connector.on("connect", function(){
            console.log(this)
        });
    },

    setNickName : function() {
        let send = {id: $('meta[name="csrf-token"]').attr('content'), nickName: $("#user_nick_name").val(), user_profile : $("#user_profile").attr("src")};
        this.connector.emit("member init", send , function(res){
            if (res.code === 1 && res.status) {
                $.ajax({
                    url     : "/chat/setNickName",
                    type    : "POST",
                    dataType: "json",
                    data    : send,
                    success : function (returnData) {
                        if (returnData.status !== false) {
                            //여기 넘어갔을 때
                            location.href = returnData.toUrl;
                        }
                    }
                });
            } else {
                alert(res.msg);
            }
        });
    }
};

$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    entranceChat.init();
});
