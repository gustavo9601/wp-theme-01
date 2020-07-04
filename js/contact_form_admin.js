console.log("administrador")

console.log("contact_form_object_js", contact_form_object_js)

//Se le añade al dom un evento de click
document.addEventListener('click', elemento => {
    //Validamos que el elemnto cliqueado haga match con la clase pasada por parametro
    if (elemento.target.matches('.u-delete')) {
        elemento.eventPreventDefault;
        //target.dataset.contactId  accedemos al valor del data-contact-id
        const id = elemento.target.dataset.contactId
        confirmDelete = confirm('Estas seguro de eliminar el comentario con ID: ' + id);
        //action: En este parametro se especifica el nombre de la funcion en el backend que recibira la peticion
        //'action' : 'mawt_contact_form_delete'

        console.log("contact_form_object_js0", contact_form_object_js)
        if (confirmDelete) {
            jQuery.ajax({
                type: 'post',
                data: {
                    'id': id,
                    'action': 'mawt_contact_form_delete'
                },
                url: contact_form_object_js.ajax_url,
                success: data => {
                    console.log("data", data);
                    let response = JSON.parse(data);
                    if (response.status) {
                        let selectorId = '[data-contact-id="' + id + '"]';
                        //Accedo al alemento hijo, y con parentElement voy primero al padre, y luego al abuelo para removerlo
                        document.querySelector(selectorId).parentElement.parentElement.remove();
                    } else {
                        return alert("Error al intentar eliminar el id " + id);
                    }
                }
            });
        } else {
            return false;
        }
    }
});