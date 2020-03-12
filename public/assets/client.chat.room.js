var chatServer = {
    connector : io.connect('http://io.homestead.test:3030/chat',{reconnection:false}),
    init : function ()
    {
        this.connector.on('connect', ()=> {
            this.userInit();
        });

        this.connector.on("broadcast", (data) => {
            this.broadCast(data);
        });

        // 새로운 유져가 온다면 알랴준다
        this.connector.on("join new user", (data) => {
            //$("#chat_contents").append("<span class='badge badge-success'>"+  users[data.id].nickName + "</span> :  "+ data.msg+"</br>");
        });

        this.connector.on("chat message", (data) => {
            this.messageReceive(data);
        });

    },
    userInit : function()
    {
        let reqData = {"id":$('meta[name="csrf-token"]').attr('content'),"nickName" : $("#nickName").val(), "user_profile" : $("#user_profile").val()};

        this.connector.emit('init user', reqData, function(users, messages)
        {
            for (let index in messages) {

                let data = messages[index];

                if (messages[index].id === reqData.id) {
                    chatServer.addMsg(data);
                } else {
                    chatServer.addMsg(data);
                }
            }

            $.scrollDown();
        });
    },
    broadCast : function()
    {
        console.dir(getLength(data))
    },
    messageReceive : function (data)
    {
        this.addMsg(data);
        $.scrollDown();
    },
    messageSend: function(obj)
    {

        var data = {
            "to"      : "all",
            "msg"     : $("#chatMsg").val(),
            "id"      : $('meta[name="csrf-token"]').attr('content'),
            "nickName": $("#nickName").val(),
            "user_profile" : $("#user_profile").val()
        };

        obj.val("");

        this.addMsg(data);

        $.scrollDown();
        this.connector.emit('chat message' , data)
    },
    addMsg : function(data, me)
    {

        let card = $(".copy")[0];
        card = $(card).clone().show();

        $(card).find("div.mr-3").css(
            {
                "background": "url('"+data.user_profile+"')",
                "background-repeat": "no-repeat",
                "background-size": "cover",
                "background-position": "center center",
                "transform": "rotate(0deg)"
            });
        $(card).find("h5.mt-0").text(data.nickName);
        $(card).find("span.msg_area").text(data.msg);

        $("#chat_contents").append(card);

    }
};

$(document).ready(function() {
    $.scrollDown = function()
    {
        $('#chat_contents').stop().animate({
            scrollTop: $('#chat_contents')[0].scrollHeight
        }, 800);
    };
    chatServer.init();
});


function getLength(obj) {
    var len = 0;

    for (key in obj) {
        if (obj.hasOwnProperty(key)) {
            len++;
        }
    }
    return len;
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
