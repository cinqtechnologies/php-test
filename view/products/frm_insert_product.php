<?php
    require_once('../../res/header.php');
?>

<script>
function insert_product(e) {
    e.preventDefault();
    var xhttp = new XMLHttpRequest();
    var params = new FormData();

    params.append("name", document.getElementById('name').value);
    params.append("price", document.getElementById('price').value);
    params.append("retailer_id", document.getElementById('retailer_id').value);
    params.append("description", document.getElementById('description').value);
    params.append("image", document.getElementById("image").files[0]);

    xhttp.onreadystatechange = function() {
        var data;
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data.success) {
                alert('Well done... ' + data.msg_success);
                document.getElementById('form_product').submit();
                return true;
            } else {
                alert('Hmmm... ' + data.msg_error);
            }
        }
    };
    xhttp.open("POST", "ajax_insert_product.php", true);
    xhttp.send(params);

    return false;
}
</script>

<div class="main_container">
    <form id="form_product" action="list_products.php" method="POST" onsubmit="return insert_product(event)">
        <fieldset style="text-align: left">
            <legend>New Product:</legend>
            Product: <input type="text" id="name" name="name" placeholder="JellyBean" required />
            Price ($): <input type="text" id="price" name="price" placeholder="1.50" size="5" required /> <br />
            Retailer: <select id="retailer_id" name="retailer_id" required />
                      <?php
                        foreach ($local_arr_retailer as $local_retailer) {
                            echo "<option value=\"" . $local_retailer->get_retailer_id() . "\">" . $local_retailer->get_name() . "</option>";
                        }
                      ?>
                      </select>
                      <br />
            Image (jpg): <input type="file" id="image" name="image" accept="image/jpeg" required /> <br />
            Description: <textarea type="text" id="description" name="description" placeholder="Your product description here..." rows="5" cols="50" required /></textarea><br /><br />
            <input type="submit" value="Save product...">
        </fieldset>
    </form>
</div>

<?php
    require_once('../../res/footer.php');
?>
