<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:86:"F:\phpStudy\WWW\shopphp\web/../source/application/store\view\setting\delivery\edit.php";i:1542766297;s:72:"F:\phpStudy\WWW\shopphp\source\application\store\view\layouts\layout.php";i:1551167251;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title><?= $setting['store']['values']['name'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="icon" type="image/png" href="assets/common/i/favicon.ico"/>
    <meta name="apple-mobile-web-app-title" content="<?= $setting['store']['values']['name'] ?>"/>
    <link rel="stylesheet" href="assets/common/css/amazeui.min.css"/>
    <link rel="stylesheet" href="assets/store/css/app.css?v=<?= $version ?>"/>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_783249_3sbba6jrt9y.css">
    <script src="assets/common/js/jquery.min.js"></script>
    <script src="//at.alicdn.com/t/font_783249_e5yrsf08rap.js"></script>
    <script>
        BASE_URL = '<?= isset($base_url) ? $base_url : '' ?>';
        STORE_URL = '<?= isset($store_url) ? $store_url : '' ?>';
    </script>
</head>

<body data-type="">
<div class="am-g tpl-g">
    <!-- 头部 -->
    <header class="tpl-header">
        <!-- 右侧内容 -->
        <div class="tpl-header-fluid">
            <!-- 侧边切换 -->
            <div class="am-fl tpl-header-button switch-button">
                <i class="iconfont icon-menufold"></i>
            </div>
            <!-- 刷新页面 -->
            <div class="am-fl tpl-header-button refresh-button">
                <i class="iconfont icon-refresh"></i>
            </div>
            <!-- 其它功能-->
            <div class="am-fr tpl-header-navbar">
                <ul>
                    <!-- 欢迎语 -->
                    <li class="am-text-sm tpl-header-navbar-welcome">
                        <a href="<?= url('store.user/renew') ?>">欢迎你，<span><?= $store['user']['user_name'] ?></span>
                        </a>
                    </li>
                    <!-- 退出 -->
                    <li class="am-text-sm">
                        <a href="<?= url('passport/logout') ?>">
                            <i class="iconfont icon-tuichu"></i> 退出
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- 侧边导航栏 -->
    <div class="left-sidebar dis-flex">
        <?php $menus = $menus ?: []; $group = $group ?: 0; ?>
        <!-- 一级菜单 -->
        <ul class="sidebar-nav">
            <li class="sidebar-nav-heading"><?= $setting['store']['values']['name'] ?></li>
            <?php foreach ($menus as $key => $item): ?>
                <li class="sidebar-nav-link">
                    <a href="<?= isset($item['index']) ? url($item['index']) : 'javascript:void(0);' ?>"
                       class="<?= $item['active'] ? 'active' : '' ?>">
                        <?php if (isset($item['is_svg']) && $item['is_svg'] == true): ?>
                            <svg class="icon sidebar-nav-link-logo" aria-hidden="true">
                                <use xlink:href="#<?= $item['icon'] ?>"></use>
                            </svg>
                        <?php else: ?>
                            <i class="iconfont sidebar-nav-link-logo <?= $item['icon'] ?>"
                               style="<?= isset($item['color']) ? "color:{$item['color']};" : '' ?>"></i>
                        <?php endif; ?>
                        <?= $item['name'] ?>
                    </a>
                </li>
            <?php endforeach; ?>

<!--            <li class="sidebar-nav-link">-->
<!--                <a href="index.php?s=/store/info/index">-->
<!--                    公司信息-->
<!--                </a>-->
<!--            </li>-->
        </ul>
        <!-- 子级菜单-->
        <?php $second = isset($menus[$group]['submenu']) ? $menus[$group]['submenu'] : []; if (!empty($second)) : ?>
            <ul class="left-sidebar-second">
                <li class="sidebar-second-title"><?= $menus[$group]['name'] ?></li>
                <li class="sidebar-second-item">
                    <?php foreach ($second as $item) : if (!isset($item['submenu'])): ?>
                            <!-- 二级菜单-->
                            <a href="<?= url($item['index']) ?>"
                               class="<?= (isset($item['active']) && $item['active']) ? 'active' : '' ?>">
                                <?= $item['name']; ?>
                            </a>
                        <?php else: ?>
                            <!-- 三级菜单-->
                            <div class="sidebar-third-item">
                                <a href="javascript:void(0);"
                                   class="sidebar-nav-sub-title <?= $item['active'] ? 'active' : '' ?>">
                                    <i class="iconfont icon-caret"></i>
                                    <?= $item['name']; ?>
                                </a>
                                <ul class="sidebar-third-nav-sub">
                                    <?php foreach ($item['submenu'] as $third) : ?>
                                        <li>
                                            <a class="<?= $third['active'] ? 'active' : '' ?>"
                                               href="<?= url($third['index']) ?>">
                                                <?= $third['name']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; endforeach; ?>
                </li>
            </ul>
        <?php endif; ?>
    </div>

    <!-- 内容区域 start -->
    <div class="tpl-content-wrapper <?= empty($second) ? 'no-sidebar-second' : '' ?>">
        <div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <form id="my-form" class="am-form tpl-form-line-form" method="post">
                    <div class="widget-body">
                        <fieldset>
                            <div class="widget-head am-cf">
                                <div class="widget-title am-fl">编辑运费模版</div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">模版名称 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="text" class="tpl-form-input" name="delivery[name]"
                                           value="<?= $model['name'] ?>" required>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">计费方式 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <label class="am-radio-inline">
                                        <input type="radio" name="delivery[method]" value="10" data-am-ucheck
                                            <?= $model['method']['value'] == 10 ? 'checked' : '' ?>> 按件数
                                    </label>
                                    <label class="am-radio-inline">
                                        <input type="radio" name="delivery[method]" value="20" data-am-ucheck
                                            <?= $model['method']['value'] == 20 ? 'checked' : '' ?>>
                                        按重量
                                    </label>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">
                                    配送区域及运费
                                </label>
                                <div class="am-u-sm-9 am-u-lg-10 am-u-end">
                                    <div class=" am-scrollable-horizontal">
                                        <table class="regional-table am-table am-table-bordered
                                         am-table-centered am-margin-bottom-xs">
                                            <tbody>
                                            <tr>
                                                <th width="42%">可配送区域</th>
                                                <th>
                                                    <span class="first">
                                                        <?= $model['method']['value'] == 10 ? '首件 (个)' : '首重 (Kg)' ?>
                                                    </span>
                                                </th>
                                                <th>运费 (元)</th>
                                                <th>
                                                    <span class="additional">
                                                          <?= $model['method']['value'] == 10 ? '续件 (个)' : '续重 (Kg)' ?>
                                                    </span>
                                                </th>
                                                <th>续费 (元)</th>
                                            </tr>
                                            <?php foreach ($model['rule'] as $item) : ?>
                                                <tr>
                                                    <td class="am-text-left">
                                                        <p class="selected-content am-margin-bottom-xs">
                                                            <?= $item['region_content'] ?>
                                                        </p>
                                                        <p class="operation am-margin-bottom-xs">
                                                            <a class="edit" href="javascript:;">编辑</a>
                                                            <a class="delete" href="javascript:;">删除</a>
                                                        </p>
                                                        <input type="hidden" name="delivery[rule][region][]"
                                                               value="<?= $item['region'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="delivery[rule][first][]"
                                                               value="<?= $item['first'] ?>" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="delivery[rule][first_fee][]"
                                                               value="<?= $item['first_fee'] ?>" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="delivery[rule][additional][]"
                                                               value="<?= $item['additional'] ?>">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="delivery[rule][additional_fee][]"
                                                               value="<?= $item['additional_fee'] ?>">
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="5" class="am-text-left">
                                                    <a class="add-region am-btn am-btn-default am-btn-xs"
                                                       href="javascript:;">
                                                        <i class="iconfont icon-dingwei"></i>
                                                        点击添加可配送区域和运费
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <label class="am-u-sm-3 am-u-lg-2 am-form-label form-require">排序 </label>
                                <div class="am-u-sm-9 am-u-end">
                                    <input type="number" class="tpl-form-input" name="delivery[sort]"
                                           value="<?= $model['sort'] ?>" required>
                                    <small>数字越小越靠前</small>
                                </div>
                            </div>
                            <div class="am-form-group">
                                <div class="am-u-sm-9 am-u-sm-push-3 am-margin-top-lg">
                                    <button type="submit" class="j-submit am-btn am-btn-secondary">提交
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="regional-choice"></div>
<script src="assets/store/js/delivery.js?v=<?= $version ?>"></script>
<script>
    $(function () {

        // 初始化区域选择界面
        var datas = JSON.parse('<?= $regionData ?>');

        // 配送区域表格
        new Delivery({
            table: '.regional-table',
            regional: '.regional-choice',
            datas: datas
        });

        /**
         * 表单验证提交
         * @type {*}
         */
        $('#my-form').superForm();

    });
</script>

    </div>
    <!-- 内容区域 end -->

</div>
<script src="assets/common/plugins/layer/layer.js"></script>
<script src="assets/common/js/jquery.form.min.js"></script>
<script src="assets/common/js/amazeui.min.js"></script>
<script src="assets/common/js/webuploader.html5only.js"></script>
<script src="assets/common/js/art-template.js"></script>
<script src="assets/store/js/app.js?v=<?= $version ?>"></script>
<script src="assets/store/js/file.library.js?v=<?= $version ?>"></script>
</body>

</html>
