<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="layui/css/layui.css" rel="stylesheet">
    <!-- 预加载优化 -->
    <link rel="preload" as="video" href="material/genshinstart.mp4">
    <style>
        .video-container {
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: #000;
        }
        #videoPlayer {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* 新增跳过按钮样式 */
        .skip-container {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
        }
        #skipBtn {
            background: rgba(0,0,0,0.5);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.3);
            transition: all 0.3s;
        }
        #skipBtn:hover {
            background: rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
<div class="video-container">
    <video id="videoPlayer" autoplay playsinline preload="auto">
        <source src="material/genshinstart.mp4" type="video/mp4">
        您的浏览器不支持视频播放
    </video>
    <!-- 新增跳过按钮 -->
    <div class="skip-container">
        <button id="skipBtn" class="layui-btn layui-btn-sm">
            <i class="layui-icon">&#xe603;</i> 跳过片头
        </button>
    </div>
</div>

<script src="layui/layui.js"></script>
<script>
    layui.use(['layer'], function(){
        const layer = layui.layer;
        const video = document.getElementById('videoPlayer');

        // 跳过按钮逻辑
        document.getElementById('skipBtn').addEventListener('click', function() {
            video.pause(); // 暂停视频
            layer.confirm('视频中有重要信息，是否跳过？', {
                icon: 3,
                title: '跳过确认',
                btn: ['确定跳过', '继续观看'],
                closeBtn: 0,
                skin: 'layui-layer-molv'
            }, function(index){
                layer.close(index);
                window.location.href = 'login.html'; // 跳转登录页
            }, function(index){
                layer.close(index);
                video.play(); // 恢复播放
            });
        });

        // 自动播放处理
        video.muted = false;
        const playPromise = video.play();

        if (playPromise !== undefined) {
            playPromise.catch(() => {
                layer.msg('<i class="layui-icon"></i> 耶稣来都得看完再走', {
                    time: 4000,
                    skin: 'layui-layer-molv',
                    anim: 6
                });

                document.addEventListener('click', function handlePlay() {
                    video.play().then(() => {
                        video.volume = 1;
                    });
                    document.removeEventListener('click', handlePlay);
                });
            });
        }

        // 视频结束处理
        video.addEventListener('ended', () => {
            window.location.href = 'login.html';
        });
    });
</script>
</body>
</html>