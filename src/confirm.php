<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>入力結果</title>
    </head>
    <body>
        <h1>入力結果</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = trim($_POST["name"] ?? "");
            $age = trim($_POST["age"] ?? "");
            $phone = trim($_POST["phone"] ?? "");
            $email = trim($_POST["email"] ?? "");
            $address = trim($_POST["address"] ?? "");
            $question = trim($_POST["question"] ?? "");
            $gender = trim($_POST["gender"] ?? "");

            $errors = [];
            $genderLabels = [
                "men" => "男性",
                "women" => "女性",
                "other" => "その他"
            ];

            if ($name === "" || !preg_match('/^[ぁ-んァ-ヶ一-龠a-zA-Z]+$/u', $name)) {
                $errors[] = "名前はひらがな、カタカナ、漢字、英字のみ使用できます。";
            }

            if ($age === "" && (!ctype_digit($age) || (int)$age < 0 || (int)$age > 150)) {
                $errors[] = "年齢は0から150の間で入力してください。";
            }

            if ($phone === "" && !preg_match('/^[0-9-]+$/', $phone)) {
                $errors[] = "電話番号は半角数字とハイフンのみ使用できます。";
            }

            if ($address === "" && !preg_match('/^[ぁ-んァ-ヶー一-龠a-zA-Z0-9-]+$/u', $address)) {
                $errors[] = "住所はひらがな、カタカナ、漢字、英字、半角数字、ハイフンのみ使用できます。";
            }

            if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "メールアドレスの形式が正しくありません。";
            }

            if ($question === "") {
                $errors[] = "質問を入力してください。";
            }

            if (!empty($errors)) {
                echo "<ul>";
                foreach ($errors as $error) {
                    echo "<li>" . htmlspecialchars($error, ENT_QUOTES, "UTF-8") . "</li>";
                }
                echo "</ul>";
                echo '<p><a href="form.php">入力画面に戻る</a></p>';
            } else {
                echo "<p>以下の内容で受け付けました。</p>";
                echo "<p>名前: " . htmlspecialchars($name, ENT_QUOTES, "UTF-8") . "</p>";
                echo "<p>年齢: " . htmlspecialchars($age, ENT_QUOTES, "UTF-8") . "</p>";
                echo "<p>電話番号: " . htmlspecialchars($phone, ENT_QUOTES, "UTF-8") . "</p>";
                echo "<p>メール: " . htmlspecialchars($email, ENT_QUOTES, "UTF-8") . "</p>";
                echo "<p>住所: " . htmlspecialchars($address, ENT_QUOTES, "UTF-8") . "</p>";
                echo "<p>質問:</p>";
                echo "<p>" . nl2br(htmlspecialchars($question, ENT_QUOTES, "UTF-8")) . "</p>";
                echo "<p>性別: " . htmlspecialchars($genderLabels[$gender] ?? "未選択", ENT_QUOTES, "UTF-8") . "</p>";
            }
        } else {
            echo '<p><a href="form.php">入力画面へ</a></p>';
        }
        ?>
    </body>
</html>