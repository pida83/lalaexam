//setTimeout(function(){ window.location.href = window.location.href; }, 6000);

Vue.component('todo-item', {
    // 이제 todo-item 컴포넌트는 "prop" 이라고 하는
    // 사용자 정의 속성 같은 것을 입력받을 수 있습니다.
    // 이 prop은 todo라는 이름으로 정의했습니다.
    props: ['todo'],
    template: '<li>{{ todo.created_at }}</li>'
});

var app = new Vue({
    el: '#app',
    delimiters: ['${', '}'],
    data: {
        message: '안녕하세요 Vue!'
    }
});

var app2 = new Vue({
    el: '#app-2',
    data: {
        message: '이 페이지는 ' + new Date() + ' 에 로드 되었습니다'
    }
});

var app3 = new Vue({
    el: '#app-3',
    data: {
        seen : true
    },

});

var app4 = new Vue({
    el: '#app-4',
    delimiters: ['${', '}'],
    data: {
        //${ list.user_id }
        lists :  []
    },
    created: function () {
        var that = this;
        // `this` 는 vm 인스턴스를 가리킵니다.
        //console.log('a is: ' + this.a)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/board/ajax',
            dateType: 'json',
            //async : false,
            data: {"param1" : "param" , "param2" : "param2"},
            success: function (returnData) {
                that.lists = JSON.parse(returnData);
            }
        });
    },
    methods: {


    }
});

var app5 = new Vue({
    el: '#app-5',
    delimiters: ['${', '}'],
    data: {
        message: '안녕하세요! Vue.js!',
    },
    methods: {
        reverseMessage: function () {
            this.message = this.message.split('').reverse().join('')
            console.log($("#app"));
        },
    }
});


var app7 = new Vue({
    el: '#app-7',
    delimiters: ['${', '}'],
    data: {
        dynamicId:"#", // v-bind dynamicID에 바인딩
        isButtonDisabled : true,
        appId : "vie",
        url : "#",
        property: "href", // 속성명 지정 시 소문자로 변환된다.
        rawHtml:'<span>test</span>',
        groceryList: [],
        isActive: true,
        hasError: true
    },
    computed: {
        compute: function() {
            this.rawHtml = "<span>computed</span>";
        },
        getCompute : function() {
            console.log("app7.property has been changed");
            this.property = "test3";
            return this.property;

        },
    },
    watch: {
        property : function(val) {
            console.log("app7.property has been changed : watch");
            console.log(val);
        }
    },
    methods : {
        getParams : function() {
            console.log("test")
        },
        getTest: function(e){
            console.log(e);
        },
        doThis : function (){
            alert("this");
        },
        doThat : function (){
            alert("that");
        }
    }
});

