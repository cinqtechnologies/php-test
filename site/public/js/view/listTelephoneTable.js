class ListTelephoneTable extends ViewMain{
    _clean() {
        $('#tableContent').empty();
    };

    update(telephone) {
        let template = this._template(telephone.retrieve());
        let formDeleteTelephone = new FormDeleteTelephone;
        let formAddTelephone = new FormAddTelephone;

        this._clean();
        $('#tableContent').append(template);

        $(".delete").click(function (event) {
            event.preventDefault();
            formDeleteTelephone.update(telephone, $(this).data("id"));
        });

        $(".edit").click(function (event) {
            event.preventDefault();
            formAddTelephone.update(telephone, $(this).data("id"));
        });
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
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            `;

        for (var i in data) {
            result += `
                    <tr>
                        <td data-label="id" data-id='${data[i].id}'>${ ++count }</td>
                        <td data-label="name">${data[i].name}</td>
                        <td data-label="telephone">
                `;
            for (var j in data[i].telephone) {
                result += `
                    (${this._formatPrefix(data[i].telephone[j].prefix)})&nbsp;
                     ${this._formatNumber(data[i].telephone[j].number)}<br />
                `
            }
            result += `
                        </td>
    
                        <td data-label="ação">
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
/*
    _formatPrefix(prefix) {
        let prefixLength = prefix.length;
        let zero = "";

        //get the zeros before the prefix
        for (let i = prefixLength; i < 2; i++) {
            zero += "0";
        }

        //concate the new prefix
        prefix = zero != "" ? zero + prefix : prefix;

        return prefix;
    }

    _formatNumber(number){
        let numberLength = number.length;

        if(numberLength == 9){
            number = number.substr(0, 5) + "-" + number.substr(5, 4);
        }else if(numberLength == 8){
            number = number.substr(0, 4) + "-" + number.substr(4, 4);
        }

        return number;
    }
    */
}