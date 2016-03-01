<h2>Update Image</h2>
<form action="processAction.php" method="post">
    URL: <input type="text" name="url" value='<?php echo $cururl ?>' required /><br />
    <input type="text" name="id" hidden value='<?php echo ($_GET["id"]); ?>' />
    <input type="text" name="act" hidden value='upPic' />

    <button onclick="document.getElementsByName('act')[0].value='upPic'">Update Picture</button>
</form>