<!DOCTYPE html><html lang=zh-CN><head><meta charset=utf-8><meta name=viewport content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0"><title>管理后台</title><link href=/dist/css/chunk-2439f615.5bbc4001.css rel=prefetch><link href=/dist/css/chunk-247633c0.8131d72c.css rel=prefetch><link href=/dist/css/chunk-3f9945b0.a261e2a4.css rel=prefetch><link href=/dist/css/chunk-538673b6.f457901a.css rel=prefetch><link href=/dist/css/chunk-6a7c1965.f3abf9bd.css rel=prefetch><link href=/dist/css/chunk-9b8ac54e.8868b1fa.css rel=prefetch><link href=/dist/js/chunk-2439f615.742b1f7a.js rel=prefetch><link href=/dist/js/chunk-247633c0.71429c91.js rel=prefetch><link href=/dist/js/chunk-2d0da573.cc6c63c1.js rel=prefetch><link href=/dist/js/chunk-2d0e5357.33e738ed.js rel=prefetch><link href=/dist/js/chunk-3821d039.201ceb37.js rel=prefetch><link href=/dist/js/chunk-3f9945b0.8275ae97.js rel=prefetch><link href=/dist/js/chunk-520bbfda.cc756724.js rel=prefetch><link href=/dist/js/chunk-538673b6.0b064a14.js rel=prefetch><link href=/dist/js/chunk-6a7c1965.310b97d1.js rel=prefetch><link href=/dist/js/chunk-775f0977.c030fe17.js rel=prefetch><link href=/dist/js/chunk-9b8ac54e.15f24baf.js rel=prefetch><link href=/dist/js/chunk-cfda387e.80b0d536.js rel=prefetch><link href=/dist/js/chunk-fd8ae5d8.b28d5f2b.js rel=prefetch><link href=/dist/css/app.d4bb6605.css rel=preload as=style><link href=/dist/css/chunk-vendors.d313cf4b.css rel=preload as=style><link href=/dist/js/app.abc66bc3.js rel=preload as=script><link href=/dist/js/chunk-vendors.87be6e22.js rel=preload as=script><link href=/dist/css/chunk-vendors.d313cf4b.css rel=stylesheet><link href=/dist/css/app.d4bb6605.css rel=stylesheet></head><body><noscript><strong>We're sorry but this page doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript><div id=progress><div id=progress-bar><div id=progress-inner></div><div style="position: absolute;width: 100%;z-index: 10">加载中，请稍后...</div></div><div id=progress-timeout style="display: none; margin-top: 10vh"><p>如果您长时间停留在此页面，请确认使用的是最新版浏览器</p><p>推荐浏览器：<a href=https://www.google.cn/intl/zh-CN_ALL/chrome/ target=_blank>Chrome</a>&nbsp;&nbsp; <a href=https://www.mozilla.org/zh-CN/firefox/ target=_blank>FireFox</a>&nbsp;&nbsp; <a href=http://browser.qq.com/ target=_blank><del>QQ浏览器</del></a></p></div><style type=text/css>#progress-timeout {position: fixed;width: 100%;}
    #progress {text-align: center;width: 100%;height: 100vh;position: absolute;background: #fff;z-index: 99999;}
    #progress-bar {border: 1px solid #eee;position: fixed;top: 0;right: 0;left: 0;height: 20px;background: #f5f5f5;width: 80%;margin: 30vh auto 0;border-radius: 8px;}
    #progress-inner {width: 1%;background: #56c0d4;position: absolute;top: 0;left: 0;bottom: 0;border-radius: 8px;}</style><script>var progress_val = 1;
    var progress_interval;

    function progress_add () {
      progress_val += parseInt(Math.random() * 2 + 5 * progress_val / 100);
      if (progress_val >= 90) {
        progress_val = 90;
        clearInterval(progress_interval);
      }
      var element = document.getElementById('progress-inner');
      if (element) element.style.width = progress_val + '%';
      else clearInterval(progress_interval);
    }
    progress_interval = setInterval(progress_add, 100);

    setTimeout(function () {
      var element = document.getElementById('progress-timeout');
      if (element) element.style.display = 'block';
    }, 10000);</script></div><div id=app></div><script>var config = @json($config);</script><script src=/dist/js/chunk-vendors.87be6e22.js></script><script src=/dist/js/app.abc66bc3.js></script></body></html>