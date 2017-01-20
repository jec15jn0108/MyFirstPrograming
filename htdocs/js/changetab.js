function ChangeTab(tabname) {
  // 全部消す
  document.getElementById('teacherbox').style.display = 'none';
  document.getElementById('studentbox').style.display = 'none';
  document.getElementById('stagebox').style.display = 'none';
  // 指定箇所のみ表示
  document.getElementById(tabname).style.display = 'block';
}
