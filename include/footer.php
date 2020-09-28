<!-- Optional JavaScript -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!------------footer--------->


<!-- Footer -->
<footer class="page-footer font-small blue footer">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="home.php" style="text-decoration: none;"> Abdelrahman</a>
    </div>
    <!-- Copyright -->

</footer>

<!-- Footer -->
<script>
function sendEmail() {
    var name = $("#name");
    var email = $("#email");
    var subject = $("#subject");
    var body = $("#body");
    if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {

        $.ajax({
            url: 'contactus.php',
            method: 'post',
            dataType: 'json',
            data: {
                name: name.val(),
                email: email.val(),
                subject: subject.val(),
                body: body.val(),
            },
            success: function(response) {
                $('#myform')[0].reset();

                alert(" message sent successfully ");
            }
        });
        return false;
    } else {
        alert("Please Try Agin!");
    }

}

function isNotEmpty(caller) {
    if (caller.val() == "") {
        caller.css('border', '1px solid red');
        return false;
    } else {
        caller.css('border', ' ');
        return true;
    }



}
</script>
<script src="js/jquery1.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
</body>

</html>