<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <?php if($css) :?>
    <?php foreach($css as $key => $value ) : ?>
        <?= "<link rel='stylesheet' type='text/css'  href=/assets/css/" . $value . '.css>' ?>
    <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>
  <div class="container">
    <?=$content?>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <?php if($js) :?>
    <?php foreach($js as $key => $value ) : ?>
        <?= "<script src=/assets/js/" . $value . ".js></script>" ?>
    <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>