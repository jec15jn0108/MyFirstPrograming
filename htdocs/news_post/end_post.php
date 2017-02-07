<?php
  require("../php/common.php");
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php head_html("お知らせ投稿　完了"); ?>
  </head>

  <body>
    <?php header_html(basename($_SERVER["PHP_SELF"], ".php")); ?>
      <div id="content">
      <main>

        <p>投稿完了</p>
        <a href="/">トップページへ</a>

      </main>

    </div>
    <?php footer_html(); ?>
  </body>
</html>
