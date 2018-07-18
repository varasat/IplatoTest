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
<?php
if ($this->type == "edit" && !empty($this->postId)){
    echo '<form class="" action="/newIplatoCodingTest/?p=blogController&a=post&postId='.$this->postId.'" method="post">';
    }else{
    echo '<form class="" action="/newIplatoCodingTest/?p=blogController&a=post" method="post">';
    }
    ?>
            <div class="burger-menu">
            <div class="burger">
                <div class="burger-toggle">Create/Edit a post</div>
                <div class="burger-body open" id="1">
                    <div>
                        <label for="title">
                            Title
                            <input type="text" name="title" value="<?=!empty($this->post)?$this->post->getTitle():""?>">
                        </label>
                    </div>
                    <div>
                        <label for="annotation">
                            Annotation
                            <input type="text" name="annotation" value="<?=!empty($this->post)?$this->post->getAnnotation():""?>">
                        </label>
                    </div>
                    <div class="under-form">
                        <label for="content">
                            Content:<textarea name="content" class="content" rows="8" cols="70"><?=!empty($this->post)?$this->post->getContent():""?></textarea>
                        </label>
                    </div>
                    <div class="burger-footer">
                        <button class="next-button" id="submit" type="submit">Submit ></button>
                    </div>
                    <div class="under-form error-box" id="error-box-1">
                        <?php
                        if (!empty($this->errorList)) {
                            foreach ($this->errorList as $error) {
                                echo "<p>$error</p>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
