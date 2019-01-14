<?php
    require_once('../../res/header.php');
?>

<script>
function insert_retailer(e) {
    e.preventDefault();
    var xhttp = new XMLHttpRequest();
    var params = new FormData();

    params.append("name", document.getElementById('name').value);
    params.append("website", document.getElementById('website').value);
    params.append("description", document.getElementById('description').value);
    params.append("logo", document.getElementById("logo").files[0]);

    xhttp.onreadystatechange = function() {
        var data;
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.success) {
                alert('Well done... ' + data.msg_success);
                document.getElementById('form_retailer').submit();
                return true;
            } else {
                alert('Hmmm... ' + data.msg_error);
            }
        }
    };
    xhttp.open("POST", "ajax_insert_retailer.php", true);
    xhttp.send(params);

    return false;
}
</script>

<div class="main_container">
    <form id="form_retailer" action="list_retailers.php" method="POST" onsubmit="return insert_retailer(event)">
        <fieldset style="text-align: left">
            <legend>New Retailer:</legend>
            Product: <input type="text" id="name" name="name" placeholder="John Doe" required />
            Website: <input type="text" id="website" name="website" placeholder="https://www.johndoe.com" size="15" required /> <br />
            Logo (jpg): <input type="file" id="logo" name="logo" accept="image/jpeg" required /> <br />
            Description: <textarea type="text" id="description" name="description" placeholder="Your product description here..." rows="5" cols="50" required /></textarea><br /><br />
            <input type="submit" value="Save product...">
        </fieldset>
    </form>
</div>

<?php
    require_once('../../res/footer.php');
?>
