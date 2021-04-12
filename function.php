<?php

// XSS対策関数
    ////ユーザーの入力値によって動的なページを作るときにおこる問題の対策
    ///　表示する時（echoする場所）でつかう！
    /// <?php echo h($val);*** ///
    /// <? = h($val); *** //


    function h($val){
        return htmlspecialchars($val, ENT_QUOTES);
    }

 // ログイン認証チェック関数
    function loginCheck(){
        if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
            echo "LOGIN Error!";
            exit();
        }else{
            //  認証できてる時　セッションリジェネレイト
            session_regenerate_id(true);
            $_SESSION["chk_ssid"] = session_id();
            // echo $_SESSION["chk_ssid"];
        }
    }


    
// 1:DBに接続する（エラー処理の追加）
    function db_connect(){
    try {
        $pdo = new PDO('mysql:dbname=my_ec_db; charset=utf8; host=localhost','root','');
    }catch (PDOException $e){
        exit('DbConnectError:'.$e->getMessage());
    }
        return $pdo;
    }
    // tryしてエラーがあったらcatchしてcatch以下を実行
    // PDOはDBに接続する関数
    // $pdoは次の部分で使うので、関数の外に出す必要がある。returnで関数の外にだす
    // 関数化すると関数の中にある変数は外からは参照できない。
    // $pdo = db_connect(); とかけばOK

?>