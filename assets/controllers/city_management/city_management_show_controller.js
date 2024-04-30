import {Controller} from '@hotwired/stimulus';
import Api from '@Api'

export default class extends Controller {

    connect() {
        const confirmDelete = this.element.querySelector('#confirm_delete');
        const deleteBtn = confirmDelete.querySelector('[data-delete-path]')

        deleteBtn.addEventListener('click', () => {
            const id = deleteBtn.getAttribute('data-delete-id')
            const path = deleteBtn.getAttribute('data-delete-path')
            const onSuccess = deleteBtn.getAttribute('data-delete-on-success')
            Api.remove(path, id);
            window.location.href = onSuccess
        });
    }
}
