class ProductsTable{
    _clean() {
        $('#tableContent').empty();
    };

    update(product) {
        let template = this._template(product);
        //let formDeleteTelephone = new FormDeleteTelephone;
        //let formAddTelephone = new FormAddTelephone;

        this._clean();
        $('#tableContent').append(template);
        /*
        $(".delete").click(function (event) {
            event.preventDefault();

            console.log('vou deletar');
            //formDeleteTelephone.update(telephone, $(this).data("id"));
        });

        $(".edit").click(function (event) {
            event.preventDefault();

            console.log('vou editar');
            //formAddTelephone.update(telephone, $(this).data("id"));
        });
        */
    }

    _template(data) {
        let count = 0;

        //table template
        let result = `
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Retailer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
            `;

        for (var i in data) {
            result += `
                    <tr>
                        <td data-label="id" data-id='${data[i].id}'>${ ++count }</td>
                        <td data-label="name">${data[i].name}</td>
                        <td data-label="image">
                            <img src="${data[i].image}" alt="${data[i].name} image"/>
                        </td>
                        <td data-label="price">${data[i].price}</td>
                        <td data-label="retailer_id"><a href="/retailer/${data[i].retailer_id}">Nome do revendedor</a></td>
                        <td data-label="action">
                            <a href="" class='edit' data-id="${data[i].id}">Edit</a>
                            <a href="" class='delete' data-id="${data[i].id}">Delete</a>
                        </td>
                    </tr>
                `;
        };

        result += `
                </tbody>
            </table>
        `;

        return result;
    }
}