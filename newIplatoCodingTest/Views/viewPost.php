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
    <script src="/newIplatoCodingTest/JS/AddComment.js"></script>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

</head>
<body>
<div class="burger-menu">
    <div class="burger">
        <div class="burger-toggle">View Post</div>
        <div class="burger-body open">
            <h1><?= $this->post->getTitle() ?></h1>
            <h2><?= $this->post->getAnnotation() ?></h2>
            <p><?= $this->post->getContent() ?></p>
            <p>Posted on <?= date("d-m-Y H:i:s", $this->post->getTimestamp()) ?></p>
            <div class="burger-footer">
                <button class="next-button" id="add-new-comment" type="button">Add new comment ></button>
            </div>
        </div>
    </div>
    <form id="comment-form" action="/newIplatoCodingTest/?p=blogController&a=addComment" method="post"
          style="display: none;">
        <div class="burger" id="comment-form" style="">
            <!--        display:none-->
            <div class="burger-toggle">Add comment</div>
            <div class="burger-body open">
                <div class="burger-body open">
                    <div>
                        <label for="subject">
                            Subject
                            <input type="text" name="subject" value="">
                        </label>
                    </div>
                    <input type="hidden" name="postId" value="<?= $_GET['postId']; ?>">
                    <div>
                        <label for="email">
                            Email Address:
                            <input type="email" name="email" value="">
                        </label>
                    </div>
                    <div class="under-form">
                        <label for="content">
                            Content:<textarea name="content" class="content" rows="8" cols="70"></textarea>
                        </label>
                    </div>
                </div>
                <div class="burger-footer">
                    <button class="next-button" id="submit-comment" type="submit">Submit Comment ></button>
                </div>
                <div class="under-form error-box" id="error-box-1">

                </div>
            </div>
        </div>
    </form>
    <div class="burger">
        <div class="burger-toggle">Comments</div>
        <div class="burger-body open" id="commentList">
            <?php
            foreach ($this->commentList as $key => $comment) {
                ?>
                <div>
                    <h2><?= !empty($comment->subject) ? $comment->subject : ""; ?></h2>
                    <p><?= !empty($comment->content) ? $comment->content : ""; ?></p>
                    <p>Posted by <?= !empty($comment->userEmail) ? $comment->userEmail : ""; ?>
                        on <?= !empty($comment->timestamp) ? date("d-m-Y H:i:s", $comment->timestamp) : ""; ?></p>
                </div>
                <?php
            }
            ?>
            <div class="burger-footer">

            </div>
        </div>
    </div>
</div>
</body>
</html>

