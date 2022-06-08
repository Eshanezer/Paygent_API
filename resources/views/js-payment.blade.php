<html>
<head>
    <meta http-equiv="content-type" content="txt/html; charset=utf-8" />
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
</head>
<body>
    <hr style="margin-top: 0;">
    <form action="pay.php" method="post" id="form">
        <div class="form-group">
            <p>请求</p>
        </div>
        <div class="form-group">
            <input type="text" name="trading_id" class="form-control" value="test12345678" placeholder="请输入订单号">
            <p class="t">示例: test12345678</p><br />
        </div>
        <div class="form-group">
            <input type="text" name="card_number" class="form-control" value="4023123456780000" placeholder="请输入信用卡号">
            <p class="t">示例: 4023123456780000</p><br />
        </div>
        <div class="form-group">
            <input type="text" name="expire_year" class="form-control" value="22" placeholder="请输入年份">
            <p class="t">示例: 19</p><br />
        </div>
        <div class="form-group">
            <input type="text" name="expire_month" class="form-control" value="09" placeholder="请输入月份">
            <p class="t">示例: 09</p><br />
        </div>
        <div class="form-group">
            <input type="text" name="cvc" class="form-control" value="123" placeholder="请输入安全码">
            <p class="t">示例: 123</p><br />
        </div>
        <div class="form-group">
            <input type="text" name="name" class="form-control" value="user" placeholder="请输入用户名">
            <p class="t">示例: user</p><br />
        </div>
        <div class="form-group">
            <input type="text" name="split_count" class="form-control" value="1" placeholder="请输入分期数">
            <p class="t">示例: 1</p><br />
        </div>
        <input type="hidden" name="card_token" val="">
        <button type="button" class="btn btn-default" onclick="checkSubmit()">提交</button>
    </form>
    <style>
        form {
            padding-left: 15px;
        }
        p {
            color: red;
        }
        .t {
            margin: 0;
        }
        .form-group {
            margin-bottom: 0;
        }
        .form-control {
            width: 40%;
        }
    </style>
    <!-- 测试环境用 -->
    <script type="text/javascript" src="https://sandbox.paygent.co.jp/js/PaygentToken.js" charset="UTF-8"></script>
    <!-- 生产环境用 -->
    <!-- <script type="text/javascript" src="https://token.paygent.co.jp/js/PaygentToken.js" charset="UTF-8"></script> -->
    <script type="text/javascript">
        function checkSubmit() {
            var card_number = $('input[name=card_number]').val()
            var expire_year = $('input[name=expire_year]').val()
            var expire_month = $('input[name=expire_month]').val()
            var cvc = $('input[name=cvc]').val()
            var name = $('input[name=trading_id]').val()
            var paygentToken = new PaygentToken()
            console.log({
                    card_number: card_number, // 卡号
                    expire_year: expire_year, // 有效年 19
                    expire_month: expire_month, // 有效月 09
                    cvc: cvc, // 安全码
                    name: 'test name', // 用户名
                });
            paygentToken.createToken(
               '38189', // merchant_id
                'test_PhgxuQmmClxvc4yHM6b5ySLd', // token
                {
                    card_number: card_number, // 卡号
                    expire_year: expire_year, // 有效年 19
                    expire_month: expire_month, // 有效月 09
                    cvc: cvc, // 安全码
                    name: 'test name', // 用户名
                }, execPurchase
            )
            return false
        }
        function execPurchase(response) {
            console.log(response);
            var msg = '';
            switch (response.result) {
                case '0000':
                    $('input[name=card_token]').val(response.tokenizedCardObject.token);
                    // $('#form').submit();
                    break;
                case '1100':
                    msg = 'マーチャントID - 必須エラー';
                    break;
                case '1200':
                    msg = 'トークン生成公開鍵 - 必須エラー';
                    break;
                case '1201':
                    msg = 'トークン生成公開鍵 - 不正エラー';
                    break;
                case '1300':
                    msg = 'カード番号 - 必須チェックエラー';
                    break;
                case '1301':
                    msg = 'カード番号 - 書式チェックエラー';
                    break;
                case '1400':
                    msg = '有効期限(年) - 必須チェックエラー';
                    break;
                case '1401':
                    msg = '有効期限(年) - 書式チェックエラー';
                    break;
                case '1500':
                    msg = '有効期限(月) - 必須チェックエラー';
                    break;
                case '1501':
                    msg = '有効期限(月) - 書式チェックエラー';
                    break;
                case '1502':
                    msg = '有効期限(年月)が不正です。';
                    break;
                case '1600':
                    msg = 'セキュリティコード - 書式チェックエラー';
                    break;
                case '1601':
                    msg = 'セキュリティコード - 必須エラー（セキュリティコードトークンの場合）';
                    break;
                case '1700':
                    msg = 'カード名義 - 書式チェックエラー';
                    break;
                case '7000':
                    msg = '非対応のブラウザです。';
                    break;
                case '7001':
                    msg = 'ペイジェントとの通信に失敗しました。';
                    break;
                case '8000':
                    msg = 'システムメンテナンス中です。';
                    break;
                case '9000':
                    msg = 'ペイジェント決済システム内部エラー';
                    break;
            }
            if (response.result != '0000') {
                alert(msg);
                alert(response.result);
            }
        }
    </script>
</body>
</html>