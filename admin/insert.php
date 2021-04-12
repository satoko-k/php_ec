<?php
    include("../function.php");
    // var_dump($_POST);
    // var_dump($_FILES);


    if(!isset($_FILES["fname"]["name"])|| $_FILES["fname"]["name"]==""){
        exit("商品画像を選択してください");
    }
    if(!isset($_POST["item"]) || $_POST["item"] ==""){
        exit("商品名を入力してください");
    }
    if(!isset($_POST["value"])|| $_POST["value"] ==""){
        exit("価格を入力してください");
    }
    if(!isset($_POST["description"])|| $_POST["description"] ==""){
        exit("商品説明を入力してください");
    }


    $fname = $_FILES["fname"]["name"];
    $item =$_POST["item"];
    $value=$_POST["value"];
    $description=$_POST["description"];

    echo $fname ;
    echo $item ;
    echo $value ;
    echo $description ;


    $upload ="../image/";

// $_FILES["fname"]["tmp_name"]を$upload（../image）の.$fname（受け取ったファイルの名前）に移動
    if(move_uploaded_file($_FILES["fname"]["tmp_name"],$upload.$fname)){
        // 成功

    }else{
        echo "アップロードに失敗しました";
        echo $_FILES["fname"]["error"];
    }



// DBへ接続
    $pdo = db_connect(); 


// ３ :データ登録のSQL作成　　:●は変数が入れない方が良い　Bind関数 sqlインデクション
    $sql="INSERT INTO ec_item_table(id, item, value, description, fname, indate)
        VALUES( NULL, :item, :value, :description, :fname, sysdate())"; 
    
    $stmt = $pdo->prepare($sql);

    // bindValue関連付け
    $stmt->bindValue(':item',$item, PDO::PARAM_STR);
    $stmt->bindValue(':value',$value, PDO::PARAM_INT);
    $stmt->bindValue(':description',$description, PDO::PARAM_STR);
    $stmt->bindValue(':fname',$fname, PDO::PARAM_STR);


    // SQLの実行　エラーがあった時だけ戻り値があり、$statusに入る
    $status = $stmt->execute();

// 4:データ登録処理後

    if($status==false){
        //SQL実行時にエラーがある場合（エラーオブジェクトを取得して表示）
        $error=$stmt->errorInfo();
        exit("QueryError:".$error[2]);
    }else{
        //5:index.phpへリダイレクト
        header("Location: item.php"); //Location: この後半角スペースを必ず入れる
        exit;
    }









?>