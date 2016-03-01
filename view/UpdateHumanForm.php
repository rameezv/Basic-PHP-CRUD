<h2>Editing Human</h2>
<h3>ID: <?php echo $data[0]["id"] ?></h3>
<form action="processAction.php" method="post">
    Name: <input type="text" name="name" value='<?php echo $data[0]["name"] ?>' required /><br />
    Job: <input type="text" name="job" value='<?php echo $data[0]["job"] ?>' /><br />
    Phone: <input type="text" name="phone" pattern="[0-9]{10}" value='<?php echo $data[0]["phone"] ?>' /><br />
    <input type="text" name="id" hidden value='<?php echo ($_GET["id"]); ?>' />
    <input type="text" name="act" hidden value='update' />

    <button onclick="document.getElementsByName('act')[0].value='update'">Update</button>
    <button onclick="document.getElementsByName('act')[0].value='delete'" class="del">Delete</button>
</form>