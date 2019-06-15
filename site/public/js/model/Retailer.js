class Retailer {
    constructor() {
        this._ajax = new Ajax("/php-test/api/public/");
    }

    //CRUD functions
    create(request, url = "retailer") {
        let response = this._ajax.request(url, null, request, "POST");
        return response.responseText;
    }

    retrieve(id = null, url = "retailer") {
        let response = this._ajax.request(url, id);
        console.log('response', response.responseJSON);
        return response.responseJSON;
    }

    update(id, request, url = "retailer") {
        let response = this._ajax.request(url, id, request, "PUT");
        return response.responseText;
    }

    delete(id, url = "retailer") {
        let response = this._ajax.request(url, id, null, "DELETE");
        return response.responseText;
    }
}