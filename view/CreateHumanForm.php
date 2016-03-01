<h2>Creating Human</h2>
<form action="processAction.php" method="post">
    Name: <input type="text" name="name" value='' required /><br />
    Job: <input type="text" name="job" value='' /><br />
    Phone: <input type="text" name="phone" pattern="[0-9]{10}" value='' /><br />
    <input type="text" name="act" hidden value='createHuman' />

    <button onclick="document.getElementsByName('act')[0].value='createHuman'">Create</button>
</form>