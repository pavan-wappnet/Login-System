$(document).ready(function () {
    $("#signupForm").on("submit", function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "signup.php",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    window.location.href = "index.html";
                } else {
                    $("#signupMessage").text(response.message).css('color', 'red');
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#signupMessage").text("An error occured. Please try again.").css('color', 'red');
            },
        });
    });

    $("#loginForm").on("submit", function (event) {
        event.preventDefault();

        var username = $("#username").val().trim();
        var password = $("#password").val().trim();

        if (username == "" || password == "") {
            alert("Please fill in both fields.");
            return;
        }

        $.ajax({
            url: "login.php",
            method: "POST",
            data: {
                username: username,
                password: password,
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    window.location.href = "dashboard.php";
                } else {
                    $("#message").text(response.message).css("color", "red");
                }
            },
            error: function () {
                alert("An error occurred. Please try again.");
            },
        });
    });
    $("#changePasswordForm").on("submit", function (event) {
        event.preventDefault(); // Prevent the form from submitting traditionally

        var formData = $(this).serialize();

        $.ajax({
            url: "change_password.php",
            method: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Handling network or server errors
                alert("An error occurred: " + textStatus + " - " + errorThrown);
            },
        });
    });

    $("#updateProfilePicForm").on("submit", function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "update_profile_picture.php",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("An error occurred: " + textStatus + " - " + errorThrown);
                console.log(errorThrown);
            },
        });
    });

});
