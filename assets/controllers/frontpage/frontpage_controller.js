import { Controller } from '@hotwired/stimulus';
import cities from '@Models/cities'
import Api from "@Api";

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
        const div = document.createElement('div')
        div.setAttribute('class', 'map-label-container position-absolute d-flex align-items-center justify-content-center')
        div.style.left = `${x}px`
        div.style.top = `${y}px`

        const label = document.createElement('div')
        label.setAttribute('class', 'map-label')
        label.innerHTML = name

        const marker = document.createElement('div')
        marker.setAttribute('class', 'map-marker')
        marker.innerHTML = '2'

        div.appendChild(label)
        div.appendChild(marker)

        return div
    }
}
