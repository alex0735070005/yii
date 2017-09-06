<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1>Staff</h1>
<div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <?= Html::beginForm(['staff/staff-phones'], 'get') ?>
                    <label>Показать всех сотрудников, у кого мобильный телефон ни разу не редактировался</label>
                    <?= Html::submitButton('Сортировать', ['class' => 'submit']) ?>
                    <?= Html::input('text', 'sort', 'phones_date', ['class' => 'hidden']) ?>
               <?= Html::endForm() ?>
            </div>
        </div>
        <div class="col-md-4">
                <?= Html::beginForm(['staff/staff-mail'], 'get') ?>
                    <label> Показать всех сотрудников и название города, у которых более одного номера телефона и e-mail заканчивается на .com</label>
                    <?= Html::submitButton('Сортировать', ['class' => 'submit']) ?>
                    <?= Html::input('text', 'sort', 'phone_mail', ['class' => 'hidden']) ?>
               <?= Html::endForm() ?>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?= Html::beginForm(['staff/staff-city'], 'get') ?>
                    <label>Сортировка по городу</label>
                    <?= Html::submitButton('Сортировать', ['class' => 'submit']) ?>
                    <select style="margin: 15px 0;" name="id" class="form-control col-md-8" id="city_change">
                        <option value="0">Все города</option>
                        <?php foreach ($cities as $city): ?>
                            <option <?= $id == $city['id'] ? 'selected' : '' ?> value="<?= $city['id'] ?>"><?= $city['name'] ?></option>
                        <?php endforeach; ?>F
                    </select>
               <?= Html::endForm() ?>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Возраст</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Город</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staff as $st): ?>
                <tr>
                    <td style="min-width: 200px;"><?= Html::encode("{$st['name']}") ?></td>
                    <td style="min-width: 200px;"><?= $st->getAge() ?></td>
                    <td>
                        <?php foreach ($st['emails'] as $em): ?>
                            <span><?= $em['name'] ?> / </span>
                        <?php endforeach; ?>
                    </td>   
                    <td>
                        <?php foreach ($st['phones'] as $ph): ?>
                            <span><?= $ph['name'] ?> / </span>
                        <?php endforeach; ?>
                    </td>                     
                    <td style="min-width: 150px;">
                        <?php foreach ($st['cities'] as $ct): ?>
                            <span><?= $ct['name'] ?></span>
                        <?php endforeach; ?>
                    </td>  
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
           <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>

<script>

</script>