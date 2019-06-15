<!DOCTYPE>
<html>
<head>
    <title>E-commerce</title>
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Dosis|Open+Sans|Source+Sans+Pro"
          rel="stylesheet">
</head>
<body>
<main>
    <div class='bottom'>
        <div id="table">
            <input type="button" class='button buttonAdd' id="addProduct" value="Add Product"/>

            <div id='tableContent'></div>
        </div>
    </div>
</main>

<div class="modal"></div>
<script src="jquery/jquery.min.js"></script>
<script src="js/service/ajax.js"></script>
<!--
  <script src="js/view/viewMain.js"></script>
  <script src="js/view/formDeleteProduct.js"></script>
  -->
<script src="js/view/ProductForm.js"></script>
<script src="js/view/ProductsTable.js"></script>
<script src="js/model/Product.js"></script>
<script src="js/controller/ProductController.js"></script>

<script>
    $(function () {
        let product = new ProductController;

        $("#addProduct").click(function (event) {
            event.preventDefault()
            product.showForm()
            alert("click");
        });
    });
</script>
</body>
</html>