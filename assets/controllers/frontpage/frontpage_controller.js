import { Controller } from '@hotwired/stimulus';
import cities from '@Models/cities'

export default class extends Controller {

    static targets = ['map']

    connect() {
        if (this.hasMapTarget) {
            const map = this.mapTarget
            cities['cities'].forEach((element) => {
                map.append(this.addMapLabel(element['name'], element['x'], element['y']))
            })
        }
    }

    addMapLabel(name, x, y)
    {
        const div = document.createElement('div');
        div.setAttribute('class', 'map-label')
        div.style.left = `${x}px`;
        div.style.top = `${y}px`;
        div.innerHTML = name
        return div
    }
}
