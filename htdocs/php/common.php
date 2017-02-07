<?php
/* head ******************************************/
function head_html($title)
{
echo <<<EOF
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Ta.K.Mi. $title</title>
  <link rel="stylesheet" href="/css/main.css" />
  <link rel="shortcut icon" href="/src/icon.ico" type="image/vnd.microsoft.icon" />

EOF;
}




/* header ****************************************/
function header_html($active)
{
  $page = [
    "index" => "", "about" => "", "access" => "", "entry" => "",
    "timetable" => "", "contact" => "", "link" => "",
  ];

  $page[$active] = 'id="active"';

echo <<<EOF
  <header>
    <div class="a">
      <h1><a href="/"><img id="logo" src="/src/images/logo.png"></a></h1>
      <p>
        <br>
        2017.02.04 (土) NAKANO CENTRAL PARK EAST 1F<br>
        13:00 ～ 16:00 (受付：12:30 ～)
      </p>
    </div><!-- inner -->
  </header>
  <div id="menu_bar">
    <nav class="menu">
      <ul>
        <li><a href="/" {$page["index"]}><strong>トップページ</strong><span>Top</span></a></li>
        <li><a href="/about" {$page["about"]}><strong>開催概要</strong><span>About</span></a></li>
        <li><a href="/entry" {$page["entry"]}><strong>参加要項</strong><span>Entry</span></a></li>
        <li><a href="/timetable" {$page["timetable"]}><strong>タイムテーブル</strong><span>Time Table</span></a></li>
        <li><a href="/access" {$page["access"]}><strong>会場アクセス</strong><span>Access</span></a></li>
        <li><a href="/contact" {$page["contact"]}><strong>問い合わせ</strong><span>Contact</span></a></li>
        <li><a href="/link" {$page["link"]}><strong>リンク</strong><span>Link</span></a></li>
      </ul>
    </nav>
  </div>

EOF;
}



/* footer ****************************************/
function footer_html()
{
echo <<<EOF
<footer>
  <nav class="footer_menu">
    <ul>
      <li><a href="/">トップページ</a></li>
      <li><a href="/about">開催概要</a></li>
      <li><a href="/entry">参加案内</a></li>
      <li><a href="/timetable">タイムテーブル</a></li>
      <li><a href="/access">会場アクセス</a></li>
      <li><a href="/contact">問い合わせ</a></li>
      <li><a href="/link">リンク</a></li>
    </ul>
  </nav>
  <br class="clear">
  <h1>主催：Ta.K.Mi.準備会</h1>
</footer>

EOF;
}


/**サイドバー********************************************************************/
function side()
{
  $news = new NewsTable();
  $str = $news->show5News();

echo <<<EOF
<aside>

  <div class="side_block">
    <div class="side_content">
      <h3>お知らせ</h3>
      <div id="side_news">
        $str
      </div>

    </div>
  </div>

  <br />

  <div class="side_block">
    <div class="side_content">
      <h3>運営Twitter</h3>
      <a class="twitter-timeline" data-width="300" data-height="600" data-theme="dark" data-link-color="#F5F8FA" href="https://twitter.com/takmi_mclt">Tweets by takmi_mclt</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
  </div>

  <br />

  <div class="side_block">
    <div class="side_content">
      <h3>共有</h3>
      <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://takmi.net" data-text="Ta.K.Mi. MinecraftLTイベント 2/4(土) pic.twitter.com/KeC9R1ewz9" data-hashtags="TaKMi">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
    </div>
  </div>
</aside>

EOF;
}
