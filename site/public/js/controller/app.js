class App {
    constructor(){
        this._telephone = new Telephone;
        this._formAddTelephone = new FormAddTelephone;
        this._table = new ListTelephoneTable;

        this.listTelephone();
    }

    listTelephone(){
        this._table.update(this._telephone);
    }
    
    addTelephone(){
        this._formAddTelephone.update(this._telephone);

        this._table.update(this._telephone);
    }
}

