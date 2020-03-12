let repositories = require("../server");

const admin = function (io) {
    io.of("/admin").on("connection", function (socket) {
        // 사용자의 정보를 세팅
        socket.on("init", function (data, func) {
            console.dir("----- admin :: s ----");
            console.log(repositories.userRepository)
            console.log(repositories.chatMessageRepository)
            console.log(repositories.nickNameRepository)
            console.dir("----- admin :: e ----");
        });
    });
};

module.exports = admin;
