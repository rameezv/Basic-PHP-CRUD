<h2>Editing Dog</h2>
<h3>ID: <?php echo $data[0]["id"] ?></h3>
<form action="processAction.php" method="post">
    Name: <input type="text" name="name" value='<?php echo $data[0]["name"] ?>' required /><br />
    Owner ID: <input type="text" name="ownerId" value='<?php echo $data[0]["ownerId"] ?>' /><br />
    <input type="text" name="id" hidden value='<?php echo ($_GET["id"]); ?>' />
    <input type="text" name="act" hidden value='update' />

    <button onclick="document.getElementsByName('act')[0].value='update'">Update</button>
    <button onclick="document.getElementsByName('act')[0].value='delete'" class="del">Delete</button>
</form>