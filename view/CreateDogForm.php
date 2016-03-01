<h2>Creating Dog</h2>
<form action="processAction.php" method="post">
    Name: <input type="text" name="name" value='' required /><br />
    Owner ID: <input type="text" name="ownerId" pattern="[0-9]{5}" /><br />
    <input type="text" name="act" hidden value='createDog' />

    <button onclick="document.getElementsByName('act')[0].value='createDog'">Create</button>
</form>