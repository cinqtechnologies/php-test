class FormDeleteTelephone {
    update(telephone, id) {
        //create instance of telephone list to update
        let listTelephoneTable = new ListTelephoneTable;

        //get the data and populate the template
        let data = telephone.retrieve(id);
        let name = data[0].name ? data[0].name : null;
        let message = `Are you shure to delete "${name}"?. These data can't be recovered`;
        let template = this._template(id, message);

        //populate and show modal form
        $(".modal").append(template);
        $(".modal").css("display", "flex");

        $("#deleteTelephone").click(function (event) {
            event.preventDefault();
            //delete telephone
            telephone.delete(id);

            //update the table list
            listTelephoneTable.update(telephone);

            //close and clear modal
            $("#cancelTelephone").click();    
        });

        $("#cancelTelephone").click(function (event) {
            event.preventDefault();

            $(".modal").css("display", "none");
            $(".modal").empty();
        });
    }

    _template(id, message) {
        let result = `
            <div class='formModalContent modalContent'>
                <h2>Delete</h2>
                <hr />
                <form class="formModal">
                    <input type="hidden" name="id" value="${id}" />
                    <div class="messageDelete">${message}</div>
                    <div class="buttonGroup">
                        <input type="submit" value="Delete" id="deleteTelephone" class='button buttonSave' />
                        <input type="button" value="Cancel" id="cancelTelephone" class='button buttonCancel' />
                    </div>
                </form>
            </div>
        `;

        return result;
    }
}