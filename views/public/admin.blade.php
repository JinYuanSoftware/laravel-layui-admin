<!DOCTYPE html>
<html id="admin">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/laravel-layui-admin/lib/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laravel-layui-admin/css/admin.css') }}">
    <script src="{{ asset('vendor/laravel-layui-admin/lib/layui/layui.js') }}"></script>
    <script src="{{ asset('vendor/laravel-layui-admin/js/admin.js') }}"></script>
</head>

<body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <a href="{{ route("admin.index") }}">
                <div class="layui-logo">{{ config("admin.system_name") }}</div>
            </a>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="/vendor/laravel-layui-admin/images/30.jpeg" class="layui-nav-img">
                        {{ auth("admin")->user()->name }}
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a onclick="admin.openLayerForm('{{ route("admin.change-password-form") }}', '修改密码', 'PATCH', '500px', '300px')">修改密码</a></dd>
                        <dd><a href="{{ route("admin.logout") }}">退出登录</a></dd>
                    </dl>
                </li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree" lay-filter="test">
                    @foreach($navigation as $topNav)
                    @if(isset($topNav['children']) && $topNav['children'])
                    <li class="layui-nav-item">
                        <a class="" href="javascript:;">{{ $topNav['name'] }}</a>
                        <dl class="layui-nav-child">
                            @foreach ($topNav['children'] as $children)
                            <dd class="{{ request()->path() == trim($children['uri'], '/') ? 'layui-this' : '' }}"><a href="#" onclick="redirect('{{ $children['uri']  }}')">{{ $children['name'] }}</a></dd>
                            @endforeach
                        </dl>
                    </li>
                    @else
                    <li class="layui-nav-item"><a href="#" onclick="redirect('{{ $topNav['uri'] }}')">{{ $topNav['name'] }}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div style="height: calc(100vh - 119px);">
            <div style="margin-left:220px">
                <div class="layadmin-pagetabs" id="LAY_app_tabs">
                    <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
                    <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
                    <div class="layui-icon layadmin-tabs-control layui-icon-down">
                        <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
                            <li class="layui-nav-item" lay-unselect>
                                <a href="javascript:;"></a>
                                <dl class="layui-nav-child layui-anim-fadein">
                                    <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                                    <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                                    <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                        <ul class="layui-tab-title" id="LAY_app_tabsheader">
                            <li lay-id="/"><i class="layui-icon layui-icon-home"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <iframe src="/{{request()->path() == 'admin' ? '' : request()->path()}}" frameborder="0" width="100%" height="100%" id="iframe"></iframe>
        </div>
        <div class="layui-footer">
            ©
            <a href="https://github.com/moell-peng/laravel-layui-admin" target="_blank">
                moell/laravel-layui-admin
            </a>
        </div>

    </div>

    <script>
        //JavaScript代码区域
        var redirect;
        layui.use(['element', 'jquery'], function() {
            var element = layui.element;
            var $ = layui.jquery;
            redirect = (url) => {
                if (url == "/admin#") {
                    return
                }
                $("#iframe").attr("src", url)
            }
        });
    </script>
</body>

</html>