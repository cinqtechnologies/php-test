class RetailerController {
    constructor() {
        this._retailer = new Retailer
        this._form = new RetailerForm
        this._table = new RetailersTable
    }

    list() {
        let self = this
        let response = self._retailer.retrieve()

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

        if (id != null) {
            response = this._retailer.retrieve(id)
        }

        let form = this._form.get(response.data)

        $(".modal").html(form)

        $("#formAdd").submit(function(e) {
            e.preventDefault()
        })
    }
}

