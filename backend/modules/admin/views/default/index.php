<?php
use kartik\date\DatePicker;

?>


<div class="admin-default-index">
    <div class="well well-sm" style="background-color: #fff; width: 245px">
        <?php

            echo DatePicker::widget([
                    //'language' => 'ru',
                    'name' => 'dp_5',
                    'type' => DatePicker::TYPE_INLINE,
                    'value' => date('D, d-M-Y'),
                    'pluginOptions' => [
                        'format' => 'D, dd-M-yyyy'
                    ],
                    'options' => []
                ])

        ?>
    </div>
</div>
