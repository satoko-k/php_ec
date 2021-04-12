<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者用商品登録フォーム</title>
</head>
<body>
    <header><h1>管理者用商品登録フォーム</h1></header>


    
        <div class="wrapper">
         <!-- enctypeは画像を送るときには必要 -->
        <form action="insert.php" method="post" class="" enctype="multipart/form-data">
            
            <p class="itemImage"><img src="../image/noimage.jpg" alt="" width="200px"></p>
            <dl class="list">
                <dt>商品画像</dt>
                <dd><input type="file" name="fname" class="" accept="image/*"></dd>
                <dt>商品名</dt>
                <dd><input type="text" name="item" placeholder="商品名を入力してください"></dd>
                <dt>金額</dt>
                <dd><input type="text" name="value" placeholder="金額を入力してください"></dd>
                <dt>商品の紹介文</dt>
                <dd><textarea name="description" id="" cols="30" rows="10">商品紹介文</textarea></dd>         
            
            </dl>
            <ul class="btn-list">
                <li><a href="">戻る</a></li>
                <li><input type="submit" id="btn-update" value="登録"></li>
            </ul>
        </form>
        
        </div><!-- /.wrapper -->

    <footer></footer>


    <!-- jQueryを読み込む！必ず先に！ -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- jsを読み込む -->
    <script>
    // 画像サムネイル表示
        $('input[type=file]').change(function(){
            // 選択したファイルを取得してfile変数に格納
            var file = $(this).prop("files")[0];
            // 画像以外の時は・・
            if(!file.type.match("image.*")){
                $(this).val("");
                $(".itemImage > img").html("");
                return;

            }
            // 画像の時は画像を表示
            var reader = new FileReader();
            reader.onload = function(){
                $(".itemImage>img").attr("src", reader.result);
            }
            reader .readAsDataURL(file);


        });
    
    </script>
</body>
</html>