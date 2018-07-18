<?php

namespace newIplatoCodingTest\Controllers;

use http\Env\Response;
use newIplatoCodingTest\Model\Blog;
use newIplatoCodingTest\Models\Admin;
use newIplatoCodingTest\Models\Comment;
use newIplatoCodingTest\Models\Post;

class BlogController
{

    /**
     * BlogController constructor.
     */
    public function __construct()
    {
        // Enable PHP Session
        if (empty($_SESSION))
            @session_start();

        $this->oUtil = new \newIplatoCodingTest\Engine\Util;

        /** Get the Model class in all the controller class **/
        $this->oUtil->getModel('Blog');
        $this->oModel = new Blog();

        /** Get the Post ID in the constructor in order to avoid the duplication of the same code **/
        $this->_iId = (int)(!empty($_GET['id']) ? $_GET['id'] : 0);
    }


    /***** Front end *****/
    /**
     *Homepage
     */
    public function index()
    {
        $this->oUtil->getView('index');
    }

    /**
     * Add new post
     */
    public function add()
    {
        if ($this->isLogged()) {
            $this->oUtil->__set("type", "new");
            $this->oUtil->getView('addNewPost');
        } else {
            $this->oUtil->getView('notAuthorised');
        }

    }

    /**
     * View a post
     */
    public function view()
    {
        $post = "";
        $comment = new Comment();
        if (!empty($_GET["postId"])) {
            $postId = $_GET["postId"];
            $post = new Post();
            $post->getById($postId);
            $commentList = $comment->getAll($postId);
        }
        $this->oUtil->__set("commentList", $commentList);
        $this->oUtil->__set("post", $post);
        $this->oUtil->getView('viewPost');
    }

    /**
     * Publishes the new post or edits the edited one
     */
    public function post()
    {
        if ($this->isLogged()) {
            $errorList = [];
            $data = [];
            $postId = "";
            //if it's an edit
            if (!empty($_GET["postId"])) {
                $postId = $_GET["postId"];
            }
            if (!empty($_POST)) {
                $data = $_POST;
                if (empty($data["title"])) {
                    $errorList[] = "Please complete the title field";
                }
                if (empty($data["annotation"])) {
                    $errorList[] = "Please complete the annotation field";
                }
                if (empty($data["content"])) {
                    $errorList[] = "Please complete the content field";
                }
            } else {
                $errorList[] = "No information has been entered. Please complete the above fields";
            }
            if (empty($errorList)) {
                $post = new Post();
                $post->setTitle($data["title"]);
                $post->setAnnotation($data["annotation"]);
                $post->setContent($data["content"]);
                //if it's an edit
                if (!empty($postId)) {
                    $post->setId($postId);
                    $post->update();
                    $postId = $post->getId();
                } else {
                    $postId = $post->add();
                }
            }
            if (!empty($postId)) {
                $this->oUtil->__set("newPostId", $postId);
                $this->oUtil->getView('postSubmitted');

            } else {
                $this->oUtil->__set("postId", $postId);
                $this->oUtil->__set("errorList", $errorList);
                $this->oUtil->__set("type", "new");
                $this->oUtil->getView('addNewPost');
            }
        } else {
            $this->oUtil->getView('notAuthorised');
        }
    }

    /**
     * page not found
     */
    public function notFound()
    {
        $this->oUtil->getView('notFound');
    }


    /**
     * view a list of all the posts
     */
    public function viewAll()
    {
        $post = new Post();
        $postList = $post->getAll();
        $this->oUtil->__set("postList", $postList);
        $this->oUtil->getView('viewAllPosts');
    }


    /**
     * Edits a post
     */
    public function edit()
    {
        if ($this->isLogged()) {
            $postId = "";
            $post = new Post();
            if (!empty($_GET["postId"])) {
                $postId = $_GET["postId"];
                $post->getById($postId);
            }
            $this->oUtil->__set("type", "edit");
            $this->oUtil->__set("postId", $postId);
            $this->oUtil->__set("post", $post);
            $this->oUtil->getView('addNewPost');
        } else {
            $this->oUtil->getView('notAuthorised');
        }

    }

    /**
     * Adds a comment
     */
    public function addComment()
    {
        $dataArray = [];
        if (!empty($_POST['subject']) && !empty($_POST['email']) && !empty($_POST['content']) && !empty($_POST['postId'])) {
            $comment = new Comment();
            $comment->setSubject($_POST['subject']);
            $comment->setUserEmail($_POST['email']);
            $comment->setContent($_POST['content']);
            $comment->setPostId($_POST['postId']);
            $dataArray = $comment->add();
        }
        //if ajax
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-type: application/json');
            echo json_encode($dataArray);
        } else {
            header("Location: " . "/newIplatoCodingTest/?p=blogController&a=view&postId=" . $_POST['postId']);
        }

    }

    /***** Back end *****/
    public function login()
    {
        $this->oUtil->getView('login');
    }

    /**
     *
     */
    public function loginCheck()
    {
        if (!empty($_POST['username'])) {
            $admin = new Admin();
            $hashedTruePassword = $admin->login($_POST['username']);
            $hashedFormPassword = sha1($_POST['password']);
            if ($hashedTruePassword == $hashedFormPassword) {
                session_start();
                $_SESSION['is_logged'] = true;
                header("Location: " . "/newIplatoCodingTest");
            } else {
                $this->oUtil->__set("error", "Something went wrong, try again");
                $this->oUtil->getView('login');
            }
        }

    }

    /**
     * @return bool
     */
    protected function isLogged()
    {
        return !empty($_SESSION['is_logged']);
    }

    /**
     *
     */
    public function delete()
    {
        if ($this->isLogged()) {
            $post = new Post();
            if (!empty($_GET["postId"])) {
                $postId = $_GET["postId"];
                $post->getById($postId);
                $post->delete();
            }
            header("Location: " . "/newIplatoCodingTest/?p=blogController&a=viewAll");

        }
    }
}
