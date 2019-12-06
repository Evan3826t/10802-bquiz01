<div class="di"
  style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
  <?php include "marquee.php";?>
  <div style="height:32px; display:block;"></div>
  <!--正中央-->
  <h3>更多最新消息顯示區</h3>
  <hr>
  <?php
    $useTable = "news";
    $total = nums( $useTable);
    // 分頁
    $div = 5;
    // 總頁數
    $pages = ceil( $total / $div);
    $now = ( !empty( $_GET['p']))?$_GET['p']:1;
    $start = ( $now-1)*$div;


    //取出資料表的所有資料
    $rows = all( $useTable, ["sh"=>1], "limit $start, $div");
  ?>
    <ol start="<?=$start+1;?>">
      <?php
        foreach( $rows as $r){
          echo "<li class='sswww'>" . mb_substr( $r['text'], 0 , 30, "utf8");
          echo "<span class='all' style='display:none'>" . $r['text']."</span>";
          echo "</li>";
        }
      ?>
  </ol>
  <div class="cent">
  <?php
    if( $now>1){
      echo "<a href='index.php?do=$useTable&p=" . ($now-1) . "' style='text-decoration:none'> < </a>";
    }
    for( $i=1; $i <= $pages; $i++){
      $fontSize=( $i== $now)?"24px":"16px";
      echo "<a href='index.php?do=$useTable&p=$i' style='font-size:$fontSize; text-decoration:none'> $i </a>";
    }
    if( $now < $pages){
      echo "<a href='index.php?do=$useTable&p=" . ($now+1) . "' style='text-decoration:none'> > </a>";
    }

    ?>
  
  </div>
</div>
<div id="alt"
  style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
</div>
<script>
  $(".sswww").hover(
    function () {
      $("#alt").html("" + $(this).children(".all").html() + "").css({
        "top": $(this).offset().top - 50
      })
      $("#alt").show()
    }
  )
  $(".sswww").mouseout(
    function () {
      $("#alt").hide()
    }
  )
</script>