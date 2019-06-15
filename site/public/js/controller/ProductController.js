class ProductController {
    constructor() {
        this._product = new Product
        this._form = new ProductForm;
        this._table = new ProductsTable

        //this.list()
    }

    list() {
        let self = this
        let response = self._product.retrieve()

        if (response.success) {
            self._table.update(response.data)
        }

        $(".edit").click(function(e) {
            e.preventDefault()
            let id = $(this).data('id')

            self.showForm(id)
        })

        $(".delete").click(function(e) {
            e.preventDefault()

        })
    }

    showForm(id) {
        let response = null

        console.log('id', id)

        if (id != null) {
            response = this._product.retrieve(id)
        }

        let form = this._form.get(response.data)

        $(".modal").html(form)

        $("#formAdd").submit(function(e) {
            e.preventDefault()
        })
    }
}

