$(document).ready(function () {
    $("#add-new-comment").click(function () {
        $("#comment-form").css("display", "block");
    })
    $("form").submit(function (e) {
        e.preventDefault(e);
        let errorList = "";
        $(".error-box").empty();
        let subject = $("input[name='subject']").val();
        let content = $("textarea[name='content']").val();
        let email = $("input[name='email']").val();
        let postId = $("input[name='postId']").val();
        //validating form
        if (isEmpty(subject) || isEmpty(content) || isEmpty(email) || isEmpty(postId)) {
            errorList = errorList + "<p>Please complete all the fields</p>"
        }
        if (!validateEmail(email)) {
            errorList = errorList + "<p>Please use a valid email address</p>"
        }
        //if the form is valid then proceed to send the comment
        if (errorList == '') {
            $.ajax({
                type: 'POST',
                url: '/newIplatoCodingTest/?p=blogController&a=addComment',
                data: {
                    'subject': subject,
                    'content': content,
                    'email': email,
                    'postId': postId
                },
                success: function (data) {
                    let comment = '<div><h2>' + data.subject + '</h2>' + '<p>' + data.content + '</p>' + '<p>posted by ' + data.userEmail + ' on ' + data.timestamp + '</p></div>';

                    $("#comment-form").css("display", "none");
                    $("input[name='subject']").val('');
                    $("textarea[name='content']").val('');
                    $("input[name='email']").val('');
                    $("#commentList").prepend(comment);

                }
            });

        }
        else {
            $(".error-box").append(errorList);
        }

    });

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function isEmpty(value) {
        return (value == null || value.length === 0);
    }

});