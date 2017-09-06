<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h3>Показать телефоны всех сотрудников, добавленных с апреля по сентябрь текущего года включительно.(Текущий год установил 2015)</h3>
<div>
    <div class="row">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Телефон</th>
                    <th>Дата создания</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($phones as $ph): ?>
                    <tr>
                        <td style="min-width: 200px;"><?= Html::encode("{$ph['name']}") ?></td>
                        <td style="min-width: 200px;"><?= $ph['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>
