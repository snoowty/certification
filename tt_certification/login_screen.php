<?php

$data = array(
    'email' => 'webukatu@webukatu.com',
    'password' => 'webukatu'
  );

//セッションを使う
session_start();
 
// 変数の初期化
$email = '';
$password = '';
$err_msg = array();
 
// POST送信があるかないか判定
if (!empty($_POST)) {
    // 各データを変数に格納
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // eメールアドレスバリデーションチェック
    // 空白チェック
    if ($email === '') {
        $err_msg['email'] = '入力必須です';
    }
    // 文字数チェック
    if (strlen($email) > 255) {
        $err_msg['email'] = '255文字で入力してください';
    }
    // パスワードバリデーションチェック
    // 空白チェック
    if ($password === '') {
        $err_msg['password'] = '入力してください';
    }
    // 文字数チェック
    if (strlen($password) > 255 || strlen($password) < 5) {
        $err_msg['password'] = '６文字以上２５５文字以内で入力してください';
    }
    // 形式チェック
    if (!preg_match("/^[a-zA-Z0-9]+$/", $password)) {
        $err_msg['password'] = '半角英数字で入力してください';
    }


    //バリデーションチェックに問題がなければ、
    //$err_msgの中身が空なのでチェックを行う
    if(empty($err_msg)){
        if($data['password'] === $password){
            //セッションにemailアドレスを挿入する
            $_SESSION['email'] = $email;
            //マイページへ遷移
            header('Location:mypage.php');
           exit;
        }else{
      $err_msg['email'] = 'eメールアドレスまたはパスワードが違います';
        }
    }
}
 
?>

<!DOCTYPE html>
 
<html lang="ja">
 
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="formScreenCSS.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>test</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <form action="" method="post">
            <div class="err_msg"><?php echo $err_msg['email']; ?></div>
            <label for=""><span>メールアドレス</span>
            <input type="email" name="email" id=""><br>
            </label>
            <div class="err_msg"><?php echo $err_msg['password']; ?></div>
            <label for=""><span>パスワード</span>
            <input type="text" name="password" id=""><br>
            </label>
            <input type="submit" value="送信">
        </form>
    </body>
</html>