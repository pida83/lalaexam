let repositories = require("../server");

let fs   = require("fs");
let ss   = require('socket.io-stream');
let path = require('path');
const uniqueString = require('unique-string');

const fileStream = function (io) {
    /*
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

        ss(socket).on("streamMp4",function(stream){

        });
    });*/
};

const fileStr = {
    ioSocket  : "",
    uploadPath: path.resolve(__dirname) + "/../../public/upload/",
    init : function(io) {
        io.of("/fileStream").on("connection", function (socket) {
            this.ioSocket = socket;
            ss(socket).on("profile-image",function(stream, data) {
                fileStr.setImage(stream, data);
            });

            ss(socket).on("streamMp4",function (stream, data) {
                fileStr.sendVideo(stream);
                //ss(socket).emit("streamMp4", stream)
            });
        });
    },
    setImage : function(stream, data) {
        let filename    = path.basename(data.name);
        let ext         = path.extname(filename);
        let newFileName = uniqueString() + ext;
        //let toFilePath  = path.resolve(__dirname) + "/../../public/upload/";
        stream.pipe(fs.createWriteStream(this.uploadPath + newFileName));

        this.socket.on("after upload", function (func) {
            //repositories.chatMessageRepository.push(data);
            func(newFileName);
            //socket.emit("after upload", newFileName);
        });
    },
    sendVideo : function(stream) {
        let file           = this.uploadPath + "/e5a5c39910ca7bb55baebaabe4535485.mp4";
        //fs.createReadStream(this.uploadPath+"/e5a5c39910ca7bb55baebaabe4535485.mp4").pipe(stream);
        //var file = this.uploadPath+"/3253f75b2fc1b4313956c9d1e88aca7b.jpg";
        //var file = this.uploadPath+"/tetete.mp4";
        //let fileReadStream = fs.createReadStream(file);
        //fileReadStream.pipe(stream);
        let size           = 0;

        let ssBlobStream = ss.createBlobReadStream(file);



    }
}

module.exports = fileStr;
