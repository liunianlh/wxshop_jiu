<div class="row-content am-cf">
    <div class="row">
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-12">
            <div class="widget am-cf">
                <div class="widget-head am-cf">
                    <div class="widget-title am-cf">用户列表</div>
                </div>
                <div class="widget-body am-fr">
                    <!-- 工具栏 -->

                    <div class="am-scrollable-horizontal am-u-sm-12">
                        <table width="100%" class="am-table am-table-compact am-table-striped
                         tpl-table-black am-text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>用户id</th>
                                <th>公司名</th>
                                <th>公司地址</th>
                                <th>联系人</th>
                                <th>联系方式</th>
                                <th>税号</th>
                                <th>开户行</th>
                                <th>账号</th>

                                <!--                                <th>注册时间</th>-->
<!--                                <th>操作</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$list->isEmpty()): foreach ($list as $item): ?>
                                <tr>
                                    <td class="am-text-middle"><?= $item['id'] ?></td>
                                    <td class="am-text-middle"><?= $item['user'] ?></td>
                                    <td class="am-text-middle"><?= $item['company'] ?></td>
                                    <td class="am-text-middle"><?= $item['address'] ?></td>
                                    <td class="am-text-middle"><?= $item['contacts'] ?></td>
                                    <td class="am-text-middle"><?= $item['phone']  ?></td>
                                    <td class="am-text-middle"><?= $item['duty'] ?></td>
                                    <td class="am-text-middle"><?= $item['opening']  ?></td>
                                    <td class="am-text-middle"><?= $item['number'] ?></td>

<!--                                    <td class="am-text-middle">-->
<!--                                        <div class="tpl-table-black-operation">-->
<!--                                            --><?php //if (checkPrivilege('user/delete')): ?>
<!--                                                <a href="javascript:void(0);"-->
<!--                                                   class="item-delete tpl-table-black-operation-del"-->
<!--                                                   data-id="--><?//= $item['user_id'] ?><!--">-->
<!--                                                    <i class="am-icon-trash"></i> 删除-->
<!--                                                </a>-->
<!--                                            --><?php //endif; ?>
<!--                                        </div>-->
<!--                                    </td>-->
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="10" class="am-text-center">暂无记录</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="am-u-lg-12 am-cf">
                        <div class="am-fr"><?= $list->render() ?> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        // 删除元素
        var url = "<?= url('user/delete') ?>";
        $('.item-delete').delete('user_id', url, '删除后不可恢复，确定要删除吗？');

    });
</script>

