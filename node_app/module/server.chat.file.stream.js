let repositories = require("../server");

let fs   = require("fs");
let ss   = require('socket.io-stream');
let path = require('path');
const uniqueString = require('unique-string');

const fileStream = function (io) {
    io.of("/fileStream").on("connection", function (socket) {
        ss(socket).on("profile-image",function(stream, data) {
            let filename    = path.basename(data.name);
            let ext         = path.extname(filename);
            let newFileName = uniqueString() + ext;
            let toFilePath  = path.resolve(__dirname) + "/../../public/upload/";
            stream.pipe(fs.createWriteStream(toFilePath + newFileName));

            socket.on("after upload", function (func) {
                //repositories.chatMessageRepository.push(data);
                func(newFileName);
                //socket.emit("after upload", newFileName);
            });

        });



    });
};

module.exports = fileStream;
