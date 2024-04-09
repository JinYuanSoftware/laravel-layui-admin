<!DOCTYPE html>
<html>
<!-- 引入头部 -->
@include("admin::public.header")
<body>

<!-- 面包屑 -->
@include("admin::public.crumb")

<!-- 主体部分开始 -->
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <!-- 内容区 -->
            @yield('content')
        </div>
    </div>
</div>
<!-- 主体部分结束 -->
@yield('script')
<!-- 引入脚部 -->
@include("admin::public.footer")
</body>
</html>
