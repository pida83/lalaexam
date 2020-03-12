let repositories = require("../server");

const member = function (io) {
    io.of('/member').on("connection", function (socket) {
        // 사용자의 닉네임을 세팅
        socket.on("member init", function (data, func) {
            console.log("init start :: ");
            console.dir(data);

            let aReturn = {
                code  : 2,
                status: false,
                msg   : "이미 존재하는 닉네임",
                data  : ""
            };

            // 첫접속이고 사용중이지 않은 닉네임 일 경우
            if (repositories.userRepository[data.id] === undefined && repositories.nickNameRepository[data.nickName] === undefined) {
                console.log("첫 접속이다.");

                repositories.userRepository[data.id]           = {"id": socket.id, "nickName": data.nickName, "profile_photo" : data.user_profile ,"isNewJoin" : true};
                repositories.nickNameRepository[data.nickName] = data.id;
                socket.nickName                                = data.nickName;
                aReturn.code                                   = 1;
                aReturn.status                                 = true;
                aReturn.msg                                    = "성공";
                return func(aReturn);
            } else {
                /**
                 * else block 은 기존 접속자 이다.
                 * 두가지로 나뉜다. 닉네임이 존재하지 않는 경우와 존재 하는경우
                 * 존재하는 경우는 (나를 포함) 누군가 선점
                 * 존재하지 않는 경우 새로운 닉네임으로 변경하는 경우
                 */
                if (repositories.nickNameRepository[data.nickName] === undefined) {
                    /**
                     * 새로운 아이디로 변경하려는 경우
                     */
                    // 기존 닉네임리스트의 내 닉네임 삭제
                    delete repositories.nickNameRepository[socket.nickName];

                    console.log("닉네임 변경 from :: " + repositories.userRepository[data.id].nickName + " to :: " + data.nickName);

                    repositories.userRepository[data.id]           = {"id": socket.id, "nickName": data.nickName, "profile_photo" : data.user_profile, "isNewJoin": false};
                    repositories.nickNameRepository[data.nickName] = data.id;
                    socket.nickName                                = data.nickName;
                    aReturn.code                                   = 1;
                    aReturn.status                                 = true;
                    aReturn.msg                                    = "닉네임이 변경 되었다";

                    return func(aReturn);
                } else {
                    /**
                     * 기존에 존재하는 닉네임의 경우 주인이 나인지 확인해야한다
                     */
                    console.log("기존 닉네임과 같다");

                    aReturn.code   = 3;
                    aReturn.status = false;
                    aReturn.msg    = "기존 닉네임과 같다";

                    if (repositories.nickNameRepository[data.nickName] !== data.id) {
                        aReturn.msg = "누군가 사용중이다";
                    }
                    return func(aReturn);
                }
            }
        });

        // 종료시
        socket.on('disconnect', function () { //3-2
            console.log("############### disconnection ################");
            //delete repositories.nickNameRepository[socket.nick];
            console.log("############### dis connection :: EE ################");
        });
    });
};

module.exports = member;
