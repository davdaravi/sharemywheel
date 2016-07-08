<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</titl>
    </head>
    <body>
        <form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
    <?php
        echo "<input type=hidden name=encRequest value=$encrypt>";
        echo "<input type=hidden name=access_code value=$access>";
    ?>
</form>
</center>
        <script language='javascript'>document.redirect.submit();</script>
    </body>
</html>
