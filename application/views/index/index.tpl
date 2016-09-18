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
                bottom: -9rem;
            }
            .expression{
                position: absolute;
                height: 1.65rem;
            }
            .expression-image{
                height: 100%;
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
            .prize-area{
                width: 10rem;
                top: 5rem;
                position: absolute;
                padding: 0rem 0.8rem;
            }
            .prize-brand{
                font-size: 1rem;
                font-weight: 900;
                width: 8rem;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
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
            .qr-code{
                position: absolute;
                height: 2.24rem;
                left: 1.25rem;
                bottom: 1.4rem;
            }
        </style>
    </head>
    <body>
        <div class="slidePage-container hide" id="slidePage-container">
            <div class="item page1">
                <div class="step step-1 slideDown">
                    <img class="page-bg" style="margin: 0rem auto;" src="/images/page-1.jpg"/>
                    <img class="down-arrow" src="/images/down-arrow.png">
                </div>
            </div>
            <div class="item page2">
                <div class="step step-2 rollInLeft">
                    <img class="page-bg" src="/images/page-2.jpg"/>
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
                <div class="step step-3 flaxLine">
                    <img class="page-bg" src="/images/page-3.jpg"/>
                    <img class="balloon" src="/images/page-3/balloon.png"/>
                </div>
            </div>
            <div class="item page4">
                <div class="winning-area hide">
                    <div class="step step-4 zoomIn">
                        <div class="prize-area">
                            <div class="prize-brand">MICHAEL KORS</div>
                            <div class="prize-name">限量版信封型卡夹</div>
                            <div class="prize-location">
                                MICHAEL KORS<br>
                                北区一层N1-08
                            </div>
                        </div>
                        <img class="page-bg" src="/images/page-4.jpg"/>
                        <img class="qr-code" src="/images/qr-code.jpg"/>
                        <img class="down-arrow hide" src="/images/down-arrow.png">
                    </div>
                </div>
            </div>
        </div>
    </body>
    {{ include file="includeJs.tpl" }}
    <script type="text/javascript" src="/js/widget/slidePage.js"></script>
    <script type="text/javascript" src="/js/widget/slidePage-touch.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
            var zoom = $(window).height()/lib.flexible.dpr/667;
            var excursion = 5 - ((750 * $(window).height())/(1334*lib.flexible.rem*2));
            if(zoom < 1){
                $('.qr-code').css({
                    'left' : 1.25 * zoom + excursion + 'rem'
                });
            }
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
                                        bottom:"0.6rem"
                                    },600);
                                },1200);
                            case 3:
                                break;
                            case 4:
                                setTimeout(function () {
                                    $('.step-4').find('.down-arrow').fadeIn();
                                },3000)
                                break;
                        }
                    },
                    'speed' : 700,
                    'refresh'  : false,
                    'unSlidePageList' : [2,3]
                });
                $('.slidePage-container').show();
                new bindBtnFunc();
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
                    slidePage.index(4);
                    $('.winning-area').show();
                });
            }
            new initPage();
    	});
    </script>
</html> 