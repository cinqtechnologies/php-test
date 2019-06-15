class ProductForm {
    get(response) {
        let template = this._template(response)

        return template;
    }
    _template(data) {
        let result = `
            <div class='formModalContent modalContent'>
                <h2>Add Product</h2>
                <hr />
                <div class='validationMessage'>Text</div>
                <form class="formModal" id="formAdd" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="${data != null ? data.id : ""}" />
                    <label>
                        <span>Name:</span> 
                        <input type="text" name="name" value="${data != null ? data.name : ""}"/>
                    </label>
                    <label>
                        <span>Retailer:</span> 
                        <select name="retailer id">
                            <option value="1">Retailer 1</option>
                        </select>
                    </label>
                    <label>
                        <span>Price:</span> 
                        <input type="text" name="price" value="${data != null ? data.name : ""}"/>
                    </label>
                    <label>
                        <span>Image:</span> 
                        <input type="file" name="image" />
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