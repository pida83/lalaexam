var fileStream = {
    connector: io.connect('http://io.homestead.test:3030/fileStream',{reconnection:false}),
    stream : ss.createStream(),
    init : function()
    {
        this.connector.on("connect", function(){
            let chunks = {data: []};
            let temp   = [];
            let cnt    = 0;
            // receive data
            //let video = document.getElementsByTagName("video");
            ss(fileStream.connector).emit("streamMp4",fileStream.stream,"data");
            fileStream.stream.on('data', function(chunk) {
                cnt++;
                // 소스 태그 하나씩 넣는거는 비효율적인거 같아서 잘라서 넣어본다 ==> 서버에서 묶어서 하나씩 내려주도록 변경 해야겠다.
                if (temp.length < 10) {
                    temp.push(chunk)
                } else {
                    chunks.data.push(URL.createObjectURL(new Blob(temp)));
                    temp = [];
                }
            });

            fileStream.stream.on("finish",function(){
                console.dir(chunks.data)
                console.log(cnt)

                let video = document.getElementsByTagName("video")[0];

                /*
                for (index in chunks.data) {
                    var source = document.createElement("sources");

                    console.log(chunks.data[index])
                    //source.setAttribute("src",chunks.data[index]);
                    //source.setAttribute("type","video/mp4");
                    video.setAttribute("src",chunks.data[index])


                    console.log(source.src)
                    //document.body.getElementsByTagName("video").appendChild(source);
                    $(video).append(source);
                }
                 */

                $(video).on("play",function() {

                });

                $(video).on("ended",function() {
                    console.log("end")
                });

                 //source.src = URL.createObjectURL(new Blob(chunk));
                 //$(video).append(source);


                //var video = document.createElement("video");
                //var video = document.getElementsByTagName("video");
                //video[0].src = URL.createObjectURL(new Blob(chunks));
                //document.body.appendChild(video);

                // var img = document.createElement("img");
                // img.src = URL.createObjectURL(new Blob(chunks));
                // console.log(img.src)
                // document.body.appendChild(img);



                // let videoData =URL.createObjectURL(new Blob(chunks));
                // $("#movv").attr("src",videoData);
                // console.log($("#movv").attr("src"))

                //document.body.appendChild(img);
                //img.src = URL.createObjectURL(new Blob(chunks));
                //document.body.appendChild(img);
            })
        });


    },
    addPlayList : function() {

    },
    sendFile : function()
    {
        var file = $("#inputGroupFile02")[0].files[0];

        if (file !== undefined) {
            // upload a file to the server.
            ss(this.connector).emit('profile-image', this.stream, {name: file.name, size:file.size});

            var blobStream = ss.createBlobReadStream(file);
            var size       = 0;

            blobStream.on('data', function(chunk) {
                size += chunk.length;
                var uploadPercent = Math.floor(size / file.size * 100) + '%';
                if (size === file.size) {
                    fileStream.connector.emit("after upload",function(fileName) {
                        $('#user_profile').attr("src","/upload/"+fileName).show();
                    });
                }
                // -> e.g. '42%'
            });

            blobStream.pipe(this.stream);
        }
    },
    uploadingProgress : function (file){

    }
};

$(document).ready(function() {

    $("#inputGroupFile02").change(function(){
        var file = $("#inputGroupFile02")[0].files[0];
        $("#fileText").text(file.name);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    fileStream.init();
});
