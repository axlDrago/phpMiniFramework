<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>

    <?php if($css) :?>
    <?php foreach($css as $key => $value ) : ?>
        <?= "<link rel='stylesheet' type='text/css'  href=/assets/css/" . $value . '.css>' ?>
    <?php endforeach; ?>
    <?php endif; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


</head>
<body>
<nav>
    <div class="nav-wrapper container">
      <a href="/" class="brand-logo">Test MVC</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="/site/">Главная</a></li>
        <li><a href="/site/about">О нас</a></li>
        <li><a href="/auth/logout">LogOut</a></li>
      </ul>
    </div>
  </nav>

  <div>
    <?=$content?>
  </div>
</body>
</html>