class RetailerForm {
    get(response) {
        let template = this._template(response)

        return template;
    }
    _template(data) {
        let result = `
            <div class='formModalContent modalContent'>
                <h2>Add Retailer</h2>
                <hr />
                <div class='validationMessage'>Text</div>
                <form class="formModal" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="${data != null ? data.id : ""}" />
                    <label>
                        <span>Website:</span> 
                        <input type="text" name="website" value="${data != null ? data.website : ""}"/>
                    </label>
                    <label>
                        <span>Description:</span> 
                        <input type="text" name="description" value="${data != null ? data.description : ""}"/>
                    </label>
                    <label>
                        <span>Logo:</span> 
                        <input type="file" name="logo" />
                    </label>
                    
                    <div class="buttonGroup">
                        <input type="submit" value="Save" id="add" class='button buttonSave' />
                        <input type="button" value="Cancel" id="closeModal" class='button buttonCancel' />
                    </div>
                </form>
            </div>
        `;

        return result;
    }
}