<?php
  require("../php/common.php");
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php head_html("お知らせ投稿"); ?>
  </head>

  <body>
    <?php header_html(basename($_SERVER["PHP_SELF"], ".php")); ?>
      <div id="content">
      <main>

        <form method="post" action="../php/add_news.php">
          タイトル: <input type="text" name="title" size="64" /><br />
          お知らせ<br />
          <textarea name="contents" rows="20" cols="160"></textarea><br />

          <input type="submit" value="投稿する" />
        </form>

      </main>

    </div>
    <?php footer_html(); ?>
  </body>
</html>
