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
    <div class="burger">
        <div class="burger-toggle">Welcome to the Coding test blog</div>
        <div class="burger-body open">
            <ul>
                <?php
                if(!empty($_SESSION['is_logged']) && $_SESSION['is_logged']){
                        ?>
                    <li>
                        <a href="/newIplatoCodingTest/?p=blogController&a=add">Add new post</a>
                    </li>
                    <?php
                }else{
                    ?>
                    <li>
                        <a href="/newIplatoCodingTest/?p=blogController&a=login">Login</a>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a href="/newIplatoCodingTest/?p=blogController&a=viewAll">View all posts</a>
                </li>
            </ul>
            <div class="burger-footer">
            </div>
        </div>
    </div>
</div>
</body>
</html>

