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
            .step-1{
                background-color: #fff;
            }
            .page-bg{
                display: block;
                margin: 0rem auto 0rem auto;
            }
            .step-2{
                background-color: #ffee03;
            }
            .page1-center{
                position: absolute;
                top: 2.5rem;
                left: -10rem;
                margin-left: -4.025rem;
                width: 8.05rem;
            }
            .page2-center{
                height: 16rem;
                margin: 0rem auto;
                display: block;
            }
            .page2-rightTop{
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
                <div class="step step-1 fadeIn">
                    <img class="page-bg" src="/images/page-5/page5-bg.png?0921"/>
                    <img class="page1-center" src="/images/page-5/page5-center.png?0921">
                    <img class="down-arrow hide" src="/images/down-arrow.png?0921">
                </div>
            </div>
            <div class="item page1">
                <div class="step step-2 rollInRight">
                    <img class="page2-rightTop" src="/images/page-4/unwinning-rightTop44.png?0921"/>
                    <img class="share-img hide" src="/images/share-friends.png?0921"/>
                    <img class="page2-center" src="/images/page-6/page6-center.png?0921" />
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
                            link: 'http://hayt.kerryon.me/share/index?source={{ $openid }}',
                            imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg?0921'
                        });
                        wx.onMenuShareAppMessage({
                            title: '#Giftoftheday 领取你的惊喜，开启好心情！',
                            desc: 'Giftoftheday How Are You Today?',
                            link: 'http://hayt.kerryon.me/share/indexsource={{ $openid }}',
                            imgUrl: 'http://'+window.location.hostname+'/images/shareImg.jpg?0921'
                        });
                    });
                }
            });
            var initPage = function () {
                setTimeout(function () {
                    $('.page1-center').animate({
                        'left' : '50%'
                    },600);
                },1000);
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
                                    $('.page2').find('.share-img').fadeIn();    
                                },3000);
                                break;
                        }
                    },
                    'speed' : 700,
                    'refresh'  : false,
                    'unSlidePageList' : [2,3]
                });
                $('.slidePage-container').fadeIn();
                _hmt.push(['_trackEvent', 'sharePage', 'sharePage']);
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