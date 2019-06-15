class Ajax {
    constructor(url) {
        this._url = this._parseUrl(url);
    }

    request(controller = null, id = null, data = null, method = "GET") {
        let url = this._url;
        
        //set controller
        url += (controller != null)? controller : "";
        
        //set id
        url += (id != null) ? "/" + id : "";

        let ajax = $.ajax({
            url: url,
            data: data,
            method: method,
            dataType: 'json',
            contentType: "application/x-www-form-urlencoded",
            async: false,
        });

        return ajax;
    }

    _parseUrl(url) {
        return url;
    }
}