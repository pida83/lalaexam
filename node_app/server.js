// server.js
let app               = require('express');
let http              = require('http').Server(app);
let io                = require('socket.io')(http);


// exports static 변수
let count                 = 0;
let userRepository        = {}; // 유져 정보
let chatMessageRepository = []; // 채팅 메세지 저장 (레디스 혹은 file 사용 가능)
let nickNameRepository    = {}; // 닉네임 저장소

module.exports = {
    count,
    userRepository,
    chatMessageRepository,
    nickNameRepository,
};

// 더 좋은 방법이 있을것 같기도 한데...
require(__dirname + "/module/server.chat.room.js")(io);
require(__dirname + "/module/server.chat.member.js")(io);
require(__dirname + "/module/server.chat.admin.js")(io);
require(__dirname + "/module/server.chat.file.stream.js").init(io);
require(__dirname + "/module/server.echo.js")(io);

http.listen(3030,"192.168.10.10", function(){
    console.log('server on!');
});

