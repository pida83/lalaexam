var fileStream = {
    connector: io.connect('http://io.homestead.test:3030/fileStream',{reconnection:false}),
    stream : ss.createStream(),
    init : function()
    {
        this.connector.on("connect", function(){
        });


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
                console.dir(uploadPercent)
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
