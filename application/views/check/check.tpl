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
        </style>
    </head>
    <body>
    </body>
    {{ include file="includeJs.tpl" }}
    <script type="text/javascript">
    	$(document).ready(function(){
            var initPage = function () {
                new bindBtnFunc();
            }
            var bindBtnFunc = function () {
            }
            new initPage();
    	});
    </script>
</html> 