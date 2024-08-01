$(document).ready(function () {
    $("#username").on("input", function () {
        var username = $(this).val();
        $.ajax({
            url: "check_username.php",
            method: "POST",
            data: { username: username },
            success: function (response) {
                if (response == "taken") {
                    alert("Username already taken");
                }
            },
        });
    });
});