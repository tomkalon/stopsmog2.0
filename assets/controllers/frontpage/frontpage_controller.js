import {Controller} from '@hotwired/stimulus';
import Api from "@Api";
import Routing from "@Routing";

export default class extends Controller {

    static targets = ['map']

    connect() {
    }
}
