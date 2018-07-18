<?php
namespace newIplatoCodingTest\Views;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Iplato Test</title>
    <link href="/newIplatoCodingTest/CSS/Blogstyle.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

</head>
<body>
<div class="burger-menu">
    <form id="comment-form" action="/newIplatoCodingTest/?p=BlogController&a=loginCheck" method="post">
        <div class="burger" id="comment-form" style="">
            <!--        display:none-->
            <div class="burger-toggle">Add comment</div>
            <div class="burger-body open">
                <div class="burger-body open">
                    <div>
                        <label for="subject">
                            Username
                            <input type="text" name="username" value="">
                        </label>
                    </div>
                    <div class="under-form">
                        <label for="password">
                            Password:
                            <input type="password" name="password" value="">
                        </label>
                    </div>
                </div>
                <div class="burger-footer">
                    <button class="next-button" id="submit-comment" type="submit">Submit></button>
                </div>
                <div class="under-form error-box" id="error-box-1">
                    <?= !empty($this->error) ? "<p>".$this->error ."</p>": ""; ?>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>





