<!DOCTYPE html>
<html>
    <head>
    	{{ include file="header.tpl" }}
        <link rel="stylesheet" type="text/css" href="/css/widget/slidePage.css">
        <link rel="stylesheet" type="text/css" href="/css/widget/page-animation.css">
    	<title>Light You Mood</title>
        <style type="text/css">
            html{
                height: 100%;
                width: 100%;
                background-color: #ffee03;
            }
            body{
                height: 100%;
                width: 100%;
            }
            .title{
                position: absolute;
                width: 6.16rem;
                top: 3rem;
                left: 1rem;
            }
            .input-area{
                position: absolute;
                top: 6.6rem;
                left: 1rem;
            }
            .input{
                width: 5rem;
                height: 1rem;
                line-height: 1rem;
                border: 0.05rem solid #000;
                display: block;
                padding: 0rem 0.2rem;
                font-size: 0.4rem;
            }
            .check-btn{
                height: 1rem;
                line-height: 1rem;
                width: 2.4rem;
                text-align: center;
                color: #ffee03;
                background-color: #000;
                margin: 0.8rem 0rem;
                font-size: 0.4rem;
                font-weight: 900;
            }
        </style>
    </head>
    <body>
        <div class="center">
            <img class="title" src="/images/check.png">
            <div class="input-area">
                <input class="input"/>
                <div class="check-btn">兑换奖品</div>
            </div>
        </div>
    </body>
    {{ include file="includeJs.tpl" }}
    <script type="text/javascript">
    	$(document).ready(function(){
            var submitSign = true;
            var initPage = function () {
                new bindBtnFunc();
            }
            var bindBtnFunc = function () {
                $('.check-btn').on('click',function () {
                    var code = $.trim($('.input').val());
                    var act_id = GetQueryString('act_id');
                    var openid = GetQueryString('openid');
                    if(code == ''){
                        alert('请输入暗号');
                    }else{
                        if(submitSign == true){
                            submitSign = false;
                            $.ajax({
                                type: 'post',
                                url: '/check/code',
                                data : {
                                    act_id : act_id,
                                    openid : openid,
                                    code : code
                                },
                                success: function(data) {
                                    var submitSign = true;
                                    if(data.code == 0){
                                        alert('二维码校验成功，请兑奖');
                                    }else{
                                        alert(data.message);
                                    }
                                }
                            });
                        }
                    }
                });
            }
            var GetQueryString = function(name){
                var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
                var r = window.location.search.substr(1).match(reg);
                if(r!=null)return  unescape(r[2]); return null;
            }
            new initPage();
    	});
    </script>
</html> 