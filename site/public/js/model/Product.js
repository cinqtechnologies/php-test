class Product {
    constructor() {
        this._ajax = new Ajax("/php-test/api/public/");
    }

    //CRUD functions
    create(request, url = "product") {
        let response = this._ajax.request(url, null, request, "POST");
        return response.responseText;
    }

    retrieve(id = null, url = "product") {
        let response = this._ajax.request(url, id);
        return response.responseJSON;
    }

    update(id, request, url = "product") {
        let response = this._ajax.request(url, id, request, "PUT");
        return response.responseText;
    }

    delete(id, url = "product") {
        let response = this._ajax.request(url, id, null, "DELETE");
        return response.responseText;
    }
}