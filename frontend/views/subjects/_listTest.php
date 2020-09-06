<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?= $this->render('_topSubMenu'); ?>
<section class="mbbs-profile">
    <div class="container">
        <div class="row">
            <div class="col-md-3"> </div>
            <div class="col-md-9 zeros">
                <h6 id='list_sub_heading'><?= $subjects[0]['sub_name'] ?></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 test">
                <div class="mbbs-left">
                    <ul>
                        <?php
                        foreach ($subjects as $sval) {
                                echo "<li class='ss'><a href = '" . $sval['sub_name'] . "' class='sub-links' semid='" . $_GET['sem_id'] . "' id ='" . $sval['sub_id'] . "' >" . $sval['sub_name'] . "</a></li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div id="partialview">
                <?= $this->render('_testView', ['defaultsubject' => $defaultsubject]);
                ?>
            </div>
        </div>
    </div>
</section>