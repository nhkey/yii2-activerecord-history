<?php

use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'options' => [
        'id' => 'elenco-vetture'
    ],
    'columns' => [
        'date:datetime',
        'field_name',
        'old_value',
        'new_value',
        'type',
        'user_id',
        'action',
    ],
]);