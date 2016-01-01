<div class="frame-menu-main horizontal-menu">
    <!--    menu-row-category || menu-col-category-->
    <div class="menu-main menu-row-category container">
        <nav>
            <table>
                <tbody>
                <tr>
                    <td>
                        <div class="frame-item-menu">
                            <div class="frame-title"><a href="?category=0" class="title" style="color: #fff;"><span
                                        class="helper" style="height: 43px;"></span><span><span
                                            class="text-el"><?php echo \Yii::t('app', 'все'); ?></span></span></a></div>
                        </div>
                    </td>
                    <?php
                    foreach ($allCategories as $i => $value) {
                        echo "<td><div class=\"frame-item-menu\"><div class=\"frame-title\"><a href=\"" . Yii::$app->urlHelper->to(['', 'category' => $value['id']]);
                        echo "\" class=\"title\" style=\"color: #fff;\">";
                        echo "<span class=\"helper\" style=\"height: 43px;\"></span><span><span class=\"text-el\">";
                        echo $value['title'];
                        echo "</span></span></a></div></div></td>";
                    } ?>
                </tr>
                </tbody>
            </table>
        </nav>
    </div>
</div>
