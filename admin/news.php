<?php
//建立一個資料表專用的變數，後續需要使用到資料表名稱的地方都使用這個變數即可
//可以減少手打的錯誤，並且方便其他功能的延用
 $useTable="news";

?>
<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
  <p class="t cent botli">最新消息資料管理</p>
  <form method="post" action="./api/edit.php">
    <table width="100%">
      <tbody>
        <tr class="yel">
          <td width="80%">最新消息資料內容</td>
          <td width="10%">顯示</td>
          <td width="10%">刪除</td>
        </tr>
        <?php
        $total = nums( $useTable);
        // 分頁
        $div = 4;
        // 總頁數
        $pages = ceil( $total / $div);
        $now = ( !empty( $_GET['p']))?$_GET['p']:1;
        $start = ( $now-1)*$div;


        //取出資料表的所有資料
        $rows = all( $useTable, [], "limit $start, $div");

        //以迴圈的方式逐筆列出資料
        foreach($rows as $r){
        ?>
        <tr class="cent">
          <td>
            <textarea name="text[]" style="width:90%;height:60px"><?=$r['text'];?></textarea>
          </td>
          <td>
            <!--checkbox是多選的機制，因此name的屬性需要使用陣列的型式-->
            <input type="checkbox" name="sh[]" value="<?=$r['id'];?>" <?=($r['sh']==1)?"checked":"";?>>
          </td>
          <td>
            <input type="checkbox" name="del[]" value="<?=$r['id'];?>">
          </td>
          <td>
            <!--這裹帶入一個隱藏欄位用來存放每筆資料的id，以利識別-->
            <input type="hidden" name="id[]" value="<?=$r['id'];?>">
          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <table style="margin-top:40px; width:70%;">
      <tbody>
        <tr>
          <!--這裹帶入一個隱藏欄位用來存放資料表名稱，以利api識別要處理的目標資料表-->
          <input type="hidden" name="table" value="<?=$useTable;?>">

          <!--這裹使用素材提供的op()函式來載入新增資料需要的表單檔案，
              同時利用get機制帶入相關的資料表名稱等資訊-->
          <td width="200px">
            <input type="button"      
                   onclick="op('#cover','#cvr','./view/<?=$useTable;?>.php?table=<?=$useTable;?>')" 
                   value="新增最新消息資料">
          </td>
          <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置"></td>
        </tr>
      </tbody>
    </table>
    <div class="cent">
<?php
if( $now>1){
  echo "<a href='admin.php?do=$useTable&p=" . ($now-1) . "' style='text-decoration:none'> < </a>";
}
for( $i=1; $i <= $pages; $i++){
  $fontSize=( $i== $now)?"24px":"16px";
  echo "<a href='admin.php?do=$useTable&p=$i' style='font-size:$fontSize; text-decoration:none'> $i </a>";
}
if( $now < $pages){
  echo "<a href='admin.php?do=$useTable&p=" . ($now+1) . "' style='text-decoration:none'> > </a>";
}

?>
</div>
  </form>
</div>