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
                background-color: #fced4f;
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
                margin: auto;
                height: 100%;
            }
        </style>
    </head>
    <body>
        <div class="slidePage-container" id="slidePage-container">
            <div class="item page1">
                <div class="step step-1 slideDown">
                    <img class="page-bg" src="/images/page-1.jpg"/>
                </div>
            </div>
            <div class="item page2">
                <div class="step step-2 rollInLeft">
                    <img class="page-bg" src="/images/page-2.jpg"/>
                </div>
            </div>
            <div class="item page3">
                <div class="step step-3 flaxLine">
                    <img class="page-bg" src="/images/page-3.jpg"/>
                </div>
            </div>
        </div>
    </body>
    {{ include file="includeJs.tpl" }}
    <script type="text/javascript" src="/js/widget/slidePage.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
            var initPage = function () {
                slidePage.init({
                    'index' : 1,
                    'after' : function(index,direction,target){},
                    'speed' : 700,
                    'refresh'  : true,
                    'useAnimation' : true
                });
                new bindBtnFunc();
            }
            var bindBtnFunc = function () {
                $('.step-2').on('click',function () {
                    slidePage.next();
                });
            }
            new initPage();
    	});
    </script>
</html> 