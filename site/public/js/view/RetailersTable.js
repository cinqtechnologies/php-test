class RetailersTable{
    _clean() {
        $('#tableContent').empty();
    };

    update(retailer) {
        let template = this._template(retailer);

        this._clean();
        $('#tableContent').append(template);
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

            console.log('data ' + i, data[i]);
            result += `
                    <tr>
                        <td data-label="id" data-id='${data[i].id}'>${ ++count }</td>
                        <td data-label="description">${data[i].description}</td>
                        <td data-label="logo">
                            <img src="${data[i].logo}" alt="${data[i].description} image"/>
                        </td>
                        <td data-label="website">${data[i].website}</td>
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