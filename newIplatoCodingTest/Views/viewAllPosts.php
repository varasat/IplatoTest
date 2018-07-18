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
<div class="burger-list">
    <div class="burger">
        <div class="burger-toggle">List of all Blog Posts</div>
        <div class="burger-body open">
            <table style="width:100%">
                <tr>
                    <td><h1>Title</h1></td>
                    <td><h1>Annotation</h1></td>
                    <td><h1>Last Edited</h1></td>
                    <td><h1>Options</h1></td>
                </tr>
                <?php
                if (!empty($this->postList)) {
                    foreach ($this->postList as $key => $post) {
                        echo "<tr>";
                        echo "<td>" . $post->title . "</td>";
                        echo "<td>" . $post->annotation . "</td>";
                        echo "<td>" . date("d-m-Y H:i:s", $post->timestamp) . "</td>";
                        if($_SESSION){
                            echo "<td><a href='/newIplatoCodingTest/?p=blogController&a=view&postId=$post->id'>View</a>/<a href='/newIplatoCodingTest/?p=blogController&a=edit&postId=$post->id'>Edit</a>/<a href='/newIplatoCodingTest/?p=blogController&a=delete&postId=$post->id'>Delete</a></td>";
                        }else{
                            echo "<td><a href='/newIplatoCodingTest/?p=blogController&a=view&postId=$post->id'>View</a></td>";
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </table>
            <div class="burger-footer">
            </div>
        </div>
    </div>
</div>
</body>
</html>
