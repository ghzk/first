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
            .item {
                height: 100%;
            }
            .step{
                height: 100%;
                overflow: auto;
            }
            .page-bg{
                display: block;
                margin: 0rem auto 0rem auto;
            }
            .step-1 .page-bg{
                width: 8rem;
                margin-top: 1rem;
            }
            .step-2 .page-bg{
                width: 7.95rem;
                height: 4.4rem;
                margin-top: 1.5rem;
            }
            .step-3 .page-bg{
                width: 8.49rem;
                margin-top: 1rem;
            }
            .step-4 .page-bg{
                height: 100%;
            }
            .step-5 .page-bg{
                height: 100%;
            }
            .down-arrow{
                position: absolute;
                bottom: 0.2rem;
                width: 1rem;
                height: 1rem;
                left: 50%;
                margin-left: -0.4rem;
                -webkit-animation: arrow-pop 1s ease-in-out infinite;
            }
            @-webkit-keyframes arrow-pop{
                0% {
                    bottom: 0.2rem;
                }
                50% {
                    bottom: 0.4rem;
                }
                100% {
                    bottom: 0.2rem;
                }
            }
            .expression-area{
                position: absolute;
                width: 10rem;
                height: 8.5rem;
                left: -10rem;
                top: 6.5rem;
            }
            .expression{
                position: absolute;
                height: 1.65rem;
            }
            .expression-image{
                height: 1.65rem;
            }
            .happy{
                left: 0.8rem;
                top: 0.4rem;
            }
            .chill{
                left: 0.8rem;
                top: 3.2rem;
            }
            .weird{
                left: 0.8rem;
                top: 6.2rem
            }
            .adorable{
                left: 5.8rem;
                top: 0.4rem;
            }
            .upset{
                left: 5.8rem;
                top: 3.2rem;
            }
            .terrible{
                left: 5.8rem;
                top: 6.2rem;
            }
            .balloon{
                position: absolute;
                right: 0.4rem;
                bottom: 1rem;
                width: 3.45rem;
                -webkit-animation: pop 2s ease-in-out infinite;
            }
            @-webkit-keyframes pop{
                0% {
                    bottom: 1rem;
                }
                40% {
                    bottom: 2rem;
                }
                100% {
                    bottom: 1rem;
                }
            }
            .winning-area{
                width: 100%;
                height: 100%;
            }
            .winning-title{
                position: absolute;
                top: 1.8rem;
                left: 50%;
                margin-left: -4.22rem;
                width: 8.44rem;
            }
            .prize-area{
                width: 10rem;
                top: 4.2rem;
                position: absolute;
                padding: 0rem 0.8rem;
            }
            .prize-brand{
                font-size: 1rem;
                font-weight: 900;
                height: 1.6rem;
                max-width: 6rem;
                display: block;
            }
            .prize-name{
                font-size: 0.6rem;
                float: left;
                background-color: #000;
                color: #ffee03;
                padding: 0.1rem;
                font-weight: 900;
                margin-top: 0.3rem;
            }
            .prize-location{
                float: left;
                clear: both;
                margin-top: 0.7rem;
                font-size: 0.5rem;
                line-height: 0.7rem;
                font-weight: 600;
            }
            .winning-bottom{
                position: absolute;
                bottom: 1.5rem;
                left: 50%;
                margin-left: -4.175rem;
                width: 8.35rem;
            }
            .qr-code{
                position: absolute;
                height: 2.3rem;
                left: 1.18rem;
                bottom: 1.6rem;
            }
            .unwinning-title{
                position: absolute;
                top: 1.8rem;
                left: 50%;
                margin-left: -4.24rem;
                width: 8.48rem;
            }
            .gift{
                position: absolute;
                width: 3.45rem;
                right: 0.8rem;
                bottom: 3rem;
            }
            .unwinning-bottom{
                position: absolute;
                bottom: 3rem;
                left: 50%;
                margin-left: -4.24rem;
                width: 8.48rem;
            }
            .unwinning-rightTop43{
                position: absolute;
                right: 0rem;
                top: 0rem;
                width: 3.1rem;
            }
            .unwinning-center43{
                position: absolute;
                left: 50%;
                margin-left: -4rem;
                top: 3rem;
                width: 8rem;
            }
            .unwinning-rightTop44{
                position: absolute;
                right: 0rem;
                top: 0rem;
                width: 4.52rem;
            }
            .unwinning-center44{
                height: 16rem;
                margin: auto;
                display: block;
            }
            .page5-center{
                height: 16rem;
                margin: 0.8rem auto;
                display: block;
            }
            .page5-rightTop{
                position: absolute;
                right: 0rem;
                top: 0rem;
                width: 4.52rem;
            }
        </style>
    </head>
    <body>
        <div class="slidePage-container hide" id="slidePage-container">
            <div class="item page1">
                <div class="step step-1 slideDown">
                    <img class="page-bg" src="/images/page-1.png"/>
                    <img class="down-arrow" src="/images/down-arrow.png">
                </div>
            </div>
            <div class="item page2">
                <div class="step step-2 rollInLeft">
                    <img class="page-bg" src="/images/page-2.png"/>
                </div>
                <div class="expression-area">
                    <div class="expression happy">
                        <img class="expression-image" src="/images/page-2/happy.png" />    
                    </div>
                    <div class="expression adorable">
                        <img class="expression-image" src="/images/page-2/adorable.png" />    
                    </div>
                    <div class="expression chill">
                        <img class="expression-image" src="/images/page-2/chill.png" />    
                    </div>
                    <div class="expression upset">
                        <img class="expression-image" src="/images/page-2/upset.png" />    
                    </div>
                    <div class="expression weird">
                        <img class="expression-image" src="/images/page-2/weird.png" />    
                    </div>
                    <div class="expression terrible">
                        <img class="expression-image" src="/images/page-2/terrible.png" />    
                    </div>
                </div>
            </div>
            <div class="item page3">
                <div class="step step-3 slideDown">
                    <img class="page-bg" src="/images/page-3.png"/>
                    <img class="balloon" src="/images/page-3/balloon.png"/>
                </div>
            </div>
            <div class="item page4">
                <div class="step step-4 zoomIn">
                    <div class="winning-area hide">
                        <img class="winning-title" src="/images/page-4/winning-title.png"/>
                        <div class="prize-area">
                            <img class="prize-brand" src=""/>
                            <div class="prize-name"></div>
                            <div class="prize-location"></div>
                        </div>
                        <img class="winning-bottom" src="/images/page-4/winning-bottom.png"/>
                        <img class="qr-code" src=""/>
                        <img class="down-arrow hide" src="/images/down-arrow.png">
                    </div>
                    <div class="unwinning-area hide">
                        {{ if ($rest_chance > 1) }}
                        <img class="unwinning-title" src="/images/page-4/unwinning-title.png"/>
                        <img class="gift heartBeat" src="/images/page-4/gift.png"/>
                        <img class="unwinning-bottom" src="/images/page-4/unwinning-bottom.png"/>
                        {{ elseif ($rest_chance == 0) }}
                        <img class="unwinning-rightTop44" src="/images/page-4/unwinning-rightTop44.png"/>
                        <img class="unwinning-center44" src="/images/page-4/unwinning-center44.png"/>
                        <img class="down-arrow hide" src="/images/down-arrow.png">
                        {{ else }}
                        <img class="unwinning-rightTop43" src="/images/page-4/unwinning-rightTop43.png"/>
                        <img class="unwinning-center43" src="/images/page-4/unwinning-center43.png"/>
                        <img class="down-arrow hide" src="/images/down-arrow.png">
                        {{ /if }}
                    </div>
                </div>
            </div>
            <div class="item page5">
                <div class="step step-5 rollInRight">
                    <img class="page5-rightTop" src="/images/page-4/unwinning-rightTop44.png"/>
                    <img class="page5-center" src="/images/page-5/page5-center.png" />
                </div>
            </div>
        </div>
    </body>
    {{ include file="includeJs.tpl" }}
    <script type="text/javascript" src="/js/widget/slidePage.js"></script>
    <script type="text/javascript" src="/js/widget/slidePage-touch.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
            var submitSign = true;
            var jsApiUrl = window.location.href.split('#')[0];
                jsApiUrl = encodeURIComponent(jsApiUrl);
            $.ajax({
                type: 'get',
                url: '/tool/wxsign?url='+jsApiUrl,
                success: function(data) {
                    wx.config({
                        debug: false,
                        appId: data.result.data.appId,
                        timestamp: data.result.data.timestamp,
                        nonceStr: data.result.data.nonceStr,
                        signature: data.result.data.signature,
                        jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage']
                    });
                    wx.ready(function(){
                        wx.onMenuShareTimeline({
                            title: '#Giftoftheday 领取你的惊喜，开启好心情！',
                            link: 'http://hayt.kerryon.me?source={{ $openid }}',
                            imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg'
                        });
                        wx.onMenuShareAppMessage({
                            title: '#Giftoftheday 领取你的惊喜，开启好心情！',
                            desc: 'Giftoftheday How Are You Today?',
                            link: 'http://hayt.kerryon.me?source={{ $openid }}',
                            imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg'
                        });
                    });
                }
            });
            var expressionSelect = false;
            var initPage = function () {
                slidePage.init({
                    'index' : 1,
                    'after' : function(index,direction,target){
                        switch (target) {
                            case 1:
                                break;
                            case 2:
                                setTimeout(function () {
                                    $('.expression-area').animate({
                                        'left' : '0rem'
                                    },600);
                                },1000);
                            case 3:
                                break;
                            case 4:
                                setTimeout(function () {
                                    $('.page4').find('.down-arrow').fadeIn();
                                },2000);
                                break;
                        }
                    },
                    'speed' : 700,
                    'refresh'  : false,
                    'unSlidePageList' : [2,3]
                });
                $('.slidePage-container').show();
                new bindBtnFunc();
                _hmt.push(['_trackEvent', 'homePage', 'homePage']);
            }
            var bindBtnFunc = function () {
                $('.expression').on('click',function () {
                    if(expressionSelect == false){
                        expressionSelect = true;
                        var $this = $(this);
                        $this.addClass('heartBeat');
                        setTimeout(function () {
                            $this.removeClass('heartBeat');
                            slidePage.index(3);
                            expressionSelect = false;
                        },1500);
                    } 
                });
                $('.balloon').on('click',function () {
                    if(submitSign == true){
                        submitSign = false;
                        $('.balloon').css({
                            '-webkit-animation' : 'none'
                        });
                        $('.balloon').animate({
                            bottom: '30rem'
                        },2000);
                        $.ajax({
                            type: 'get',
                            url: '/prize/lucky',
                            success: function(data) {
                                submitSign = true;
                                setTimeout(function () {
                                    slidePage.index(4);
                                    switch (data.code) {
                                        case 0:
                                            $('.winning-area').show();
                                            $('.prize-name').html(data.result.prize.product);
                                            $('.prize-location').html(data.result.prize.brand + '<br>' + data.result.prize.location);
                                            $('.prize-brand').attr('src',data.result.prize.logo+'?imageView2/2/w/480');
                                            $('.qr-code').attr('src',data.result.qrcode);
                                            break;
                                        case 10010:
                                            $('.unwinning-area').show();
                                            break;
                                        case 10011:
                                            $('.unwinning-area').show();
                                            break;
                                    }
                                },1000);
                            }
                        });
                        wx.ready(function(){
                            wx.onMenuShareTimeline({
                                title: 'Giftoftheday How Are You Today?',
                                link: 'http://hayt.kerryon.me?source={{ $openid }}',
                                imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg'
                            });
                            wx.onMenuShareAppMessage({
                                title: 'Giftoftheday How Are You Today?',
                                desc: '#Giftoftheday 领取你的惊喜，开启好心情！',
                                link: 'http://hayt.kerryon.me?source={{ $openid }}',
                                imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg'
                            });
                        });
                        _hmt.push(['_trackEvent', 'getPrice', 'getPrice']);
                    }
                });
                $('.gift').on('click',function () {
                    if(submitSign == true){
                        submitSign = false;
                        $.ajax({
                            type: 'get',
                            url: '/prize/lucky',
                            success: function(data) {
                                submitSign = true;
                                switch (data.code) {
                                    case 0:
                                        $('.unwinning-area').hide();
                                        $('.winning-area').show();
                                        $('.prize-name').html(data.result.prize.product);
                                        $('.prize-location').html(data.result.prize.brand + '<br>' + data.result.prize.location);
                                        $('.prize-brand').attr('src',data.result.prize.logo+'?imageView2/2/w/480');
                                        $('.qr-code').attr('src',data.result.qrcode);
                                        break;
                                    case 10010:
                                        var html = 
                                            '<img class="unwinning-rightTop43" src="/images/page-4/unwinning-rightTop43.png"/>'+
                                            '<img class="unwinning-center43" src="/images/page-4/unwinning-center43.png"/>'+
                                            '<img class="down-arrow hide" src="/images/down-arrow.png">'
                                        $('.unwinning-area').html(html);
                                        break;
                                    case 10011:
                                        var html = 
                                            '<img class="unwinning-rightTop44" src="/images/page-4/unwinning-rightTop44.png"/>'+
                                            '<img class="unwinning-center44" src="/images/page-4/unwinning-center44.png"/>'+
                                            '<img class="down-arrow hide" src="/images/down-arrow.png">';
                                        $('.unwinning-area').html(html);
                                        break;
                                }
                            }
                        });
                        wx.ready(function(){
                            wx.onMenuShareTimeline({
                                title: 'Giftoftheday How Are You Today?',
                                link: 'http://hayt.kerryon.me?source={{ $openid }}',
                                imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg'
                            });
                            wx.onMenuShareAppMessage({
                                title: 'Giftoftheday How Are You Today?',
                                desc: '#Giftoftheday 领取你的惊喜，开启好心情！',
                                link: 'http://hayt.kerryon.me?source={{ $openid }}',
                                imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg'
                            });
                        });
                        _hmt.push(['_trackEvent', 'getPrice', 'getPrice']);
                    }
                });
            }
            new initPage();
    	});
    </script>
    <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "//hm.baidu.com/hm.js?fce7bf99b5708f0317ab48f067c0aba4";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
    </script>
</html> 