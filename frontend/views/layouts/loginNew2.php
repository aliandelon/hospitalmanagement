<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\Login3Asset;
use yii\helpers\Html;

Login3Asset::register($this);
?>
<?php $this->head() ?>

<?php $this->beginPage() ?>
<body>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <style>
      body{
          font-family: 'Poppins', sans-serif;
      }
      #gradient_bg{
        background: url(<?= Yii::$app->request->baseUrl; ?>/images/bg.jpg);
        background-position:center;
        height: 100vh;
        padding:7%;

      }
      .form-bg{
          padding: 3rem;
          box-shadow: 0 0 47px 0 rgba(0, 0, 0, 0.08);
          background-color:#fff;
      }
      .btn-custom{
         background:#05AB9E;
        background: -webkit-linear-gradient(to bottom, #16E6D5, #05AB9E);  
        background: linear-gradient(to bottom, #16E6D5, #05AB9E);
        border: 0px solid #000;
        color: #fff;
      }
      @media only screen and (max-width:767px) {
       #gradient_bg{
        padding:4%;

      }
    }
  </style>
    <section id="gradient_bg">
        <div class= "container">
            <div class="row">
                <div class="col-md-3"></div>
                    <div class="col-md-6 col-sm-12 col-lg-6 col-xs-12">
                        <div class="form-bg text-center">
                            <img src="<?= Yii::$app->request->baseUrl; ?>/images/logo.png" style="height:100px; margin-bottom:1rem;" class="img-fluid" alt="logo">
                    <h2 class="text-center" style="margin-bottom:1rem">LogIn</h2>
            <div class="w3ls-login box box--big">
                     <?= $content ?>
           </div>
                          </div>
                           <div class="col-md-3"></div>
                    </div>
             </div>
    </section>
            
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>