<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framework POO</title>
    <link rel="stylesheet" type="text/css" href="asset/css/style.css">
  </head>
  <body>

    <header>
      <nav>
          <ul>
              <li><a href="<?= $view->path('home'); ?>">Home</a></li>
          </ul>
      </nav>
    </header>

    <div class="container">
        <?= $content; ?>
    </div>

    <footer>

    </footer>

    <script src="asset/js/main.js"></script>
  </body>
</html>
