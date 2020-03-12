let repositories = require("../server");

const chat = function (io) {

    io.of('/chat').on('connection', function (socket) {
        let name = "user" + ++repositories.count;
        console.log("############### connected ################");

        // 사용자의 정보를 세팅
        socket.on("init user", function (data, func) {
            data.user_profile = (data.user_profile)? data.user_profile :  "http://image.club5678.com/imgs/mobile/q_call_plus/img/thum_avatar2-f.png";
            repositories.userRepository[data.id]           = {"id": socket.id, "nickName": data.nickName, "user_profile" : data.user_profile};
            repositories.nickNameRepository[data.nickName] = data.id;
            socket.uniqId                                  = data.id;
            socket.nickName                                = data.nickName;
            func(repositories.userRepository, repositories.chatMessageRepository);
        });

        // 종료시
        socket.on('disconnect', function (s) { //3-2
            repositories.count--;
            console.log("############### disconnection ################");
            delete repositories.userRepository[socket.uniqId];
            console.log("############### dis connection :: EE ################");
        });

        socket.on("chat message", function (data) {
            data.user_profile = (data.user_profile)? data.user_profile :  "http://image.club5678.com/imgs/mobile/q_call_plus/img/thum_avatar2-f.png";
            repositories.chatMessageRepository.push(data);
            socket.broadcast.emit("chat message", data);
        });
    });

};

module.exports = chat;
