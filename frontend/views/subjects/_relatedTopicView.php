<?php /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ ?>
<div class = "separator">
    <div class = "answer-left2">
        <img class = "ans img-responsive gg" src = "images/de.jpg">
        <h3>sasha</h3>
        <span class = "dat">Calicut university</span>
        <span class = "dat">1 Year</span>
    </div>
    <div class = "answer-right2">
        <span class = "content">
            <?
            $string = strip_tags($model->con_text);
            if (strlen($string) > 200) {
            $stringCut = substr($string, 0, 200);
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/this/story">Read More</a>';
            }
            echo $string; ?>

        </span>
        <span class="dates">Posted on <?= $model->cod ?></span>
    </div>
</div>

