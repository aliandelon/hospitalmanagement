<?php
$this->title = 'Choose Plan';
$this->params['breadcrumbs'][] = ['label' => 'Student Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="packages">
        <div class="container">
                <div class="row">
                        <?php
                        echo $this->render('_form', ['allplans' => $allplans, 'id' => $id]);
                        ?>
                </div>
        </div>
</section>

