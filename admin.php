<?php require_once($_SERVER['DOCUMENT_ROOT']."/includes/kernel.php"); ?>

<?php
  login_valid();
  
  if(login_valid() and login_restricted(3))
  {
    $db_connection = db_connect();

    $title = "Admin overview";

    ?>

    <html lang="en">
      <head>
        <?php include($_SERVER['DOCUMENT_ROOT']."/includes/head.php"); ?>
        <title><?=$title;?></title>
        <script type="text/javascript" src="./includes/cards.js"></script>
      </head>
      <body>
        <div class="wrapper">
          <?php include($_SERVER['DOCUMENT_ROOT']."/includes/header.php"); ?>
          <?php include($_SERVER['DOCUMENT_ROOT']."/includes/navigation.php"); ?>     
          <div class="page-wrapper">
            <div class="container-xl">
              <div class="page-header d-print-none">
                <div class="row align-items-center">
                  <div class="col">
                    <h2 class="page-title">
                      <?=$title;?>
                    </h2>
                  </div>
                  <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                      <a href="./api/v1/export.php" class="btn btn-primary">Export data</a>
                      <a href="./api/v1/export.php?anonymise=1" class="btn">Export anonymised data</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>   
            <div class="page-body">
              <div class="container-xl">
                <div class="row row-cards">
                  <div class="col-md-6 col-xl-4">
                    <div class="row row-cards">
                      <div class="col-12">
                        <?php output_logins(15); ?>
                      </div>
                      <div class="col-12">
                        <?php output_members(30); ?>
                      </div>
                      <div class="col-12">
                        <?php output_polls(25); ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-8">
                    <div class="row row-cards">
                      <div class="col-12">
                        <?php output_notifications(30); ?>
                      </div>

                      <div class="col-12">
                        <?php output_ensembles(10); ?>
                      </div>
                      <div class="col-12">
                        <?php output_terms(30); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php include($_SERVER['DOCUMENT_ROOT']."/includes/footer.php"); ?>
          </div>
        </div>

        <script src="./dist/js/tabler.min.js"></script>
        <script src="./dist/js/demo.min.js"></script>
      </body>
    </html>
    <?php db_disconnect($db_connection); ?>

    <?php
  }
  else
  {
    output_restricted_page();
  }
?>