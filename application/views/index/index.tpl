<!DOCTYPE html>
<html>
    <head>
    	{{ include file="header.tpl" }}
        <link rel="stylesheet" type="text/css" href="/css/widget/slidePage.css">
        <link rel="stylesheet" type="text/css" href="/css/widget/page-animation.css">
    	<title>how are you today</title>
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
                width: 8.4rem;
                margin-top: 0.6rem
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
            .step-5{
                background-color: #fff;
            }
            .step-5 .page-bg{
                height: 100%;
            }
            .step-6 .page-bg{
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
            .expression-click-img{
                position: absolute;
                top: 1rem;
                right: 0.6rem;
                width: 1.17rem;
                -webkit-animation: expressionClick 1s ease-in-out infinite;
            }
            @-webkit-keyframes expressionClick{
                0% {
                    right: 0.6rem;
                }
                40% {
                    right: 1rem;
                }
                100% {
                    right: 0.6rem;
                }
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
                left: 4.6rem;
                top: 0.4rem;
            }
            .upset{
                left: 4.6rem;
                top: 3.2rem;
            }
            .terrible{
                left: 4.6rem;
                top: 6.2rem;
            }
            .balloon{
                position: absolute;
                right: 0.4rem;
                top: 3.6rem;
                width: 3.45rem;
            }
            .balloon-animation{
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
            .balloon-click-img{
                position: absolute;
                top: 11rem;
                left: 0.8rem;
                width: 4.57rem;
                -webkit-animation: balloonClick 1s ease-in-out infinite;
            }
            @-webkit-keyframes balloonClick{
                0% {
                    left: 0.8rem;
                }
                40% {
                    left: 1.4rem;
                }
                100% {
                    left: 0.8rem;
                }
            }
            .winning-area{
                width: 100%;
                height: 100%;
            }
            .winning-title{
                position: absolute;
                top: 2.8rem;
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
                max-width: 8rem;
                display: block;
                margin-top: 0.6rem;
            }
            .prize-brand-font{
                margin-top: 0.3rem;
                font-size: 0.5rem;
                font-weight: 900;
            }
            .prize-location{
                float: left;
                clear: both;
                margin-top: 0.3rem;
                font-size: 0.4rem;
                line-height: 0.7rem;
                font-weight: 600;
                color: #0064e1;
            }
            .winning-bottom{
                position: absolute;
                bottom: 1rem;
                left: 50%;
                margin-left: -4.175rem;
                width: 8.35rem;
            }
            .qr-code{
                position: absolute;
                height: 2.4rem;
                left: 1.2rem;
                bottom: 2.55rem;
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
                right: 0.3rem;
                bottom: 2.9rem;
            }
            .unwinning-bottom{
                position: absolute;
                bottom: 3rem;
                left: 0.8rem;
                width: 4.52rem;
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
                position: absolute;
                top: 2.5rem;
                left: 50%;
                margin-left: -4.025rem;
                width: 8.05rem;
            }
            .page5-center-box{
                position: absolute;
                height: 100%;
                width: 100%;
                background-color: rgba(255,255,255,0.9);
                top: 0rem;
                left: -10rem;
            }
            .page6-center{
                height: 16rem;
                margin: 0rem auto;
                display: block;
            }
            .page6-rightTop{
                position: absolute;
                right: 0rem;
                top: 1.5rem;
                width: 3.52rem;
            }
            .share-img{
                position: absolute;
                width: 5.75rem;
                right: 0.4rem;
                top: 0.4rem;
            }
        </style>
    </head>
    <body>
        <div class="slidePage-container hide" id="slidePage-container">
            <div class="item page1">
                <div class="step step-1 forceDown">
                    <img class="page-bg" src="/images/page-1.png?0921 F"/>
                    <img class="down-arrow hide" src="/images/down-arrow.png?0921">
                </div>
            </div>
            <div class="item page2">
                <div class="step step-2 rollInLeft">
                    <img class="page-bg" src="/images/page-2.png?0921"/>
                </div>
                <div class="expression-area">
                    <div class="expression happy">
                        <img class="expression-image" src="/images/page-2/happy.png?0921" />    
                    </div>
                    <div class="expression adorable">
                        <img class="expression-image" src="/images/page-2/adorable.png?0921" />    
                    </div>
                    <div class="expression chill">
                        <img class="expression-image" src="/images/page-2/chill.png?0921" />    
                    </div>
                    <div class="expression upset">
                        <img class="expression-image" src="/images/page-2/upset.png?0921" />    
                    </div>
                    <div class="expression weird">
                        <img class="expression-image" src="/images/page-2/weird.png?0921" />    
                    </div>
                    <div class="expression terrible">
                        <img class="expression-image" src="/images/page-2/terrible.png?0921" />    
                    </div>
                    <img class="expression-click-img" src="/images/page-2/click.png?0921"/>
                </div>
            </div>
            <div class="item page3">
                <div class="step step-3 slideDown">
                    <img class="page-bg" src="/images/page-3.png?0921"/>
                    <img class="balloon" src="/images/page-3/balloon.png?0921"/>
                    <img class="balloon-click-img" src="/images/page-3/click.png?0921"/>
                </div>
            </div>
            <div class="item page4">
                <div class="step step-4 zoomIn">
                    <div class="winning-area hide">
                        <img class="winning-title" src="/images/page-4/winning-title.png?0921"/>
                        <div class="prize-area">
                            <img class="prize-brand" src=""/>
                            <div class="prize-brand-font"></div>
                            <div class="prize-location"></div>
                        </div>
                        <img class="winning-bottom" src="/images/page-4/winning-bottom.png?0921"/>
                        <img class="qr-code" src=""/>
                        <img class="share-img hide" src="/images/share.png?0921"/>
                        <img class="down-arrow hide" src="/images/down-arrow.png?0921">
                    </div>
                    <div class="unwinning-area hide">
                        {{ if ($rest_chance > 1) }}
                        <img class="unwinning-title" src="/images/page-4/unwinning-title.png?0921"/>
                        <img class="gift" src="/images/page-4/gift.png?09212"/>
                        <img class="unwinning-bottom" src="/images/page-4/unwinning-bottom.png?0921"/>
                        <img class="balloon-click-img" src="/images/page-3/click.png?0921"/>
                        {{ elseif ($rest_chance == 0) }}
                        <img class="unwinning-rightTop44" src="/images/page-4/unwinning-rightTop44.png?0921"/>
                        <img class="unwinning-center44" src="/images/page-4/unwinning-center44.png?0921"/>
                        <img class="down-arrow hide" src="/images/down-arrow.png?0921">
                        {{ else }}
                        <img class="unwinning-rightTop43" src="/images/page-4/unwinning-rightTop43.png?0921"/>
                        <img class="unwinning-center43" src="/images/page-4/unwinning-center43.png?0921"/>
                        <img class="down-arrow hide" src="/images/down-arrow.png?0921">
                        {{ /if }}
                    </div>
                </div>
            </div>
            <div class="item page5">
                <div class="step step-5 fadeIn">
                    <img class="page-bg" src="/images/page-5/page5-bg.jpg?0921"/>
                    <div class="page5-center-box">
                        <img class="page5-center" src="/images/page-5/page5-center.png?0921">    
                    </div>
                    <img class="down-arrow hide" src="/images/down-arrow.png?0921">
                </div>
            </div>
            <div class="item page6">
                <div class="step step-6 rollInRight">
                    <img class="page6-rightTop" src="/images/page-4/unwinning-rightTop44.png?0921"/>
                    <img class="share-img hide" style="width:3.89rem" src="/images/share-friends.png?0921"/>
                    <img class="page6-center" src="/images/page-6/page6-center.png?0922" />
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
                            imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg?0921'
                        });
                        wx.onMenuShareAppMessage({
                            title: '#Giftoftheday 领取你的惊喜，开启好心情！',
                            desc: 'Giftoftheday How Are You Today?',
                            link: 'http://hayt.kerryon.me?source={{ $openid }}',
                            imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg?0921'
                        });
                    });
                }
            });
            var expressionSelect = false;
            var initPage = function () {
                setTimeout(function () {
                    $('.step-1 .down-arrow').fadeIn();
                },2000);
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
                                $('.unwinning-area').hide();
                                break;
                            case 3:
                                setTimeout(function () {
                                    $('.expression-area').css({
                                        'left' : '-10rem'
                                    });
                                },1000);
                                break;
                            case 4:
                                $('.balloon').css({
                                    'top' : '3.6rem'
                                });
                                break;
                            case 5:
                                setTimeout(function () {
                                    $('.page5-center-box').animate({
                                        'left' : '0rem'
                                    },600);
                                },1000);
                                setTimeout(function () {
                                    $('.step-5 .down-arrow').fadeIn();
                                },2000);
                                break;
                            case 6:
                                setTimeout(function () {
                                    $('.page6').find('.share-img').fadeIn();    
                                },1500);
                                break;
                        }
                    },
                    'speed' : 700,
                    'refresh'  : false,
                    'unSlidePageList' : [2,3]
                });
                $('.slidePage-container').fadeIn();
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
                        setTimeout(function () {
                            $('.balloon').animate({
                                'top' : '-15rem'
                            },800);    
                        },100);
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
                                            $('.prize-brand-font').html(data.result.prize.brand);
                                            $('.prize-location').html('PICK IT UP: '+data.result.location_en+'<br>领取地点:' + data.result.prize.location);
                                            $('.prize-brand').attr('src',data.result.prize.logo+'?imageView2/2/w/480');
                                            $('.qr-code').attr('src',data.result.qrcode);
                                            setTimeout(function () {
                                                $('.winning-area').find('.down-arrow').fadeIn();
                                            },2000);
                                            setTimeout(function () {
                                                $('.winning-area').find('.share-img').fadeIn();
                                            },3000);
                                            break;
                                        case 10010:
                                            $('.unwinning-area').show();
                                            setTimeout(function () {
                                                $('.unwinning-area').find('.down-arrow').fadeIn();
                                            },2000);
                                            break;
                                        case 10011:
                                            $('.unwinning-area').show();
                                            setTimeout(function () {
                                                $('.unwinning-area').find('.down-arrow').fadeIn();
                                            },2000);
                                            break;
                                    }
                                },1000);
                            }
                        });
                        wx.ready(function(){
                            wx.onMenuShareTimeline({
                                title: 'Giftoftheday How Are You Today?',
                                link: 'http://hayt.kerryon.me?source={{ $openid }}',
                                imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg?0921'
                            });
                            wx.onMenuShareAppMessage({
                                title: 'Giftoftheday How Are You Today?',
                                desc: '#Giftoftheday 领取你的惊喜，开启好心情！',
                                link: 'http://hayt.kerryon.me?source={{ $openid }}',
                                imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg?0921'
                            });
                        });
                        _hmt.push(['_trackEvent', 'getPrice', 'getPrice']);
                    }
                });
                $('.gift').on('click',function () {
                    slidePage.index(2);
                    var html = 
                        '<img class="unwinning-rightTop43" src="/images/page-4/unwinning-rightTop43.png?0921"/>'+
                        '<img class="unwinning-center43" src="/images/page-4/unwinning-center43.png?0921"/>'+
                        '<img class="down-arrow hide" src="/images/down-arrow.png?0921">';
                    $('.unwinning-area').html(html);
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