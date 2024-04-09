<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title')</title>
    <link href="/static/admin/assets/images/favicon.ico" rel="icon">
    <link rel="stylesheet" href="/static/admin/assets/libs/layui/css/layui.css" />
    <link rel="stylesheet" href="/static/admin/assets/module/admin.css?v=318" />
    <link rel="stylesheet" href="/static/admin/assets/css/theme-all.css?v=318" />
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <!-- 头部 -->
        <div class="layui-header">
            <div class="layui-logo">{{ config("admin.system_name") }}</div>
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item" lay-unselect>
                    <a ew-event="flexible" title="侧边伸缩"><i class="layui-icon layui-icon-shrink-right"></i></a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a ew-event="refresh" title="刷新"><i class="layui-icon layui-icon-refresh-3"></i></a>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a ew-event="fullScreen" title="全屏"><i class="layui-icon layui-icon-screen-full"></i></a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a ew-event="lockScreen" title="锁屏"><i class="layui-icon layui-icon-password"></i></a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a>
                        <img src="@if (!empty($adminInfo['avatar_url'])) {{$adminInfo['avatar_url']}} @else /static/admin/assets/images/logo.png @endif" class="layui-nav-img">
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a onclick="admin.openLayerForm('{{ route("admin.change-password-form") }}', '修改密码', 'PATCH', '500px', '300px')">修改密码</a></dd>
                        <dd><a href="{{ route("admin.logout") }}">退出登录</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a ew-event="theme" title="主题"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
            </ul>
        </div>
        <!-- 侧边栏 -->
        <div class="layui-side">
            <div class="layui-side-scroll">
                <ul class="layui-nav layui-nav-tree "  lay-filter="admin-side-nav" lay-shrink="_all" style="margin: 15px 0;">
                    @foreach ($navigation as $vo)
                    <li class="layui-nav-item">
                        @if ($vo['uri'] == "/admin/index")
                        <a lay-href="/admin/index"><i class="layui-icon {{$vo['icon']}}"></i>&emsp;<cite>{{$vo['name']}}</cite></a>
                        @else
                        <a ><i class="layui-icon {{$vo['icon']}}"></i>&emsp;<cite>{{$vo['name']}}</cite></a>
                        @endif
                        @if (isset($vo['children']) && !empty($vo['children']))
                        <dl class="layui-nav-child">
                            @foreach ($vo['children'] as $k => $v)
                            <dd><a lay-href="{{$v['uri']}}">{{$v['name']}}</a></dd>
                            @endforeach
                        </dl>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- 主体部分 -->
        <div class="layui-body"></div>
        <!-- 底部 -->
        <div class="layui-footer layui-text">
            copyright © 2018~2024 <a href="https://www.rxthink.cn" target="_blank">rxthink.cn</a> all rights reserved.
            <span class="pull-right"></span>
        </div>
    </div>

    <!-- 加载动画 -->
    <div class="page-loading">
        <div class="ball-loader">
            <span></span><span></span><span></span><span></span>
        </div>
    </div>

    <!-- js部分 -->
    <script type="text/javascript" src="/static/admin/assets/libs/layui/layui.js"></script>
    <script type="text/javascript" src="/static/admin/assets/js/common.js?v=318"></script>
    <script>
        layui.use(['index'], function() {
            var $ = layui.jquery;
            var index = layui.index;
            // 默认加载主页
            index.loadHome({
                menuPath: '/admin/nft',
                menuName: '<i class="layui-icon layui-icon-home"></i>'
            });

        });
    </script>
</body>

</html>