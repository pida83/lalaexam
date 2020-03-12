let repositories = require("../server");

const echoServer = function (io) {
    io.of('/echoServer').on('connection', function (socket) {

        // 채팅에 접속
        socket.on("join chat", function (data, func) {

        });

        // 게시판에 접속
        socket.on("join board", function (data, func) {

        });

        // 종료시
        socket.on('disconnect', function (s) { //3-2

        });
    });
};

module.exports = echoServer;
