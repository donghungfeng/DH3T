﻿<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
        }

        body{
            background:url('./img/bg.jpg') repeat 0 0;
            background-size:100%;
            perspective: 1000px;
        }


        ul,li,ol{
            list-style:none;
        }

        .box{
            width:200px;
            height:200px;
            margin:300px auto;
            position: relative;
            transform-style: preserve-3d;
            transform:rotateX(12deg);
            animation: move 5s linear infinite;
        }

        .minbox{
            width:100px;
            height:100px;
            position: absolute;
            left:50px;
            top:50px;
            transform-style: preserve-3d;
        }

        .minbox li{
            width:100px;
            height:100px;
            position: absolute;
            top:0;
            left:0;
        }

        /* 正面 */
        .minbox li:nth-child(1){ 
            background: url("img/01.jpg") no-repeat 0 0;
            transform:translateZ(50px);
        }
        
        /* 背面 */
        .minbox li:nth-child(2){
            background: url("img/02.jpg") no-repeat 0 0;
            transform:rotateX(180deg) translateZ(50px);
        }
        
        /* 下面 */
        .minbox li:nth-child(3){
            background: url("img/03.jpg") no-repeat 0 0;
            -webkit-transform:rotateX(-90deg) translateZ(50px);
        }
        
        /* 上面 */
        .minbox li:nth-child(4){
            background: url("img/04.jpg") no-repeat 0 0;
            -webkit-transform:rotateX(90deg) translateZ(50px);

        }
        
        /* 左边 */
        .minbox li:nth-child(5){
            background: url("img/05.jpg") no-repeat 0 0;
            -webkit-transform:rotateY(-90deg) translateZ(50px);
        }
        
        /* 右边 */
        .minbox li:nth-child(6){
			background: url("img/06.jpg") no-repeat 0 0;
			-webkit-transform:rotateY(90deg) translateZ(50px);
		}


        .maxbox{
            width:200px;
            height:200px;
            position: absolute;
            left:0;
            top:0;
            transform-style: preserve-3d;
        }

        .maxbox li{
            width:200px;
            height:200px;
            background:#fff;
            border:1px solid #ccc;
            position: absolute;
            left:0;
            top:0;
            opacity: 0.2;
            transition: all 1s ease;
        }
        
        /* 正面 */
        .maxbox li:nth-child(1){
            -webkit-transform:translateZ(100px);
        }
        
        /* 背面 */
        .maxbox li:nth-child(2){
            -webkit-transform:rotateX(180deg) translateZ(100px);
        }
        
        /* 下面 */
        .maxbox li:nth-child(3){
            -webkit-transform:rotateX(-90deg) translateZ(100px);
        }
        
        /* 上面 */
        .maxbox li:nth-child(4){
			-webkit-transform:rotateX(90deg) translateZ(100px);
		}

        /* 左边 */
		.maxbox li:nth-child(5){
			-webkit-transform:rotateY(-90deg) translateZ(100px);
		}

        /* 右边 */
		.maxbox li:nth-child(6){
			-webkit-transform:rotateY(90deg) translateZ(100px);
		}

        .box:hover ol li:nth-child(1){
			-webkit-transform:translateZ(300px);
		}
		.box:hover ol li:nth-child(2){
			-webkit-transform:rotateX(180deg) translateZ(300px);
		}
		.box:hover ol li:nth-child(3){
			-webkit-transform:rotateX(-90deg) translateZ(300px);
		}
		.box:hover ol li:nth-child(4){
			-webkit-transform:rotateX(90deg) translateZ(300px);
		}
		.box:hover ol li:nth-child(5){
			-webkit-transform:rotateY(-90deg) translateZ(300px);
		}
		.box:hover ol li:nth-child(6){
			-webkit-transform:rotateY(90deg) translateZ(300px);
		}

        @keyframes move{
            0%{
                transform:rotateX(13deg) rotateY(0deg);
            }
            100%{
                transform:rotateX(13deg) rotateY(360deg);
            }
        }






    </style>
</head>
<body>
    <div class="box">
        <ul class="minbox">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <ol class="maxbox">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ol>
    </div>
</body>
</html>