import {Controller} from '@hotwired/stimulus';
import cities from '@Models/cities'
import Api from "@Api";
import Routing from "@Routing";

export default class extends Controller {

    static targets = ['map']

    connect() {
        if (this.hasMapTarget) {
            Api.get(
                'api_cities_get',
                [],
                this.citiesHandler.bind(this)
            )
        }
    }

    citiesHandler(data, params, options) {
        const map = this.mapTarget
        let cities = data['hydra:member']
        cities.forEach((city) => {
            map.append(this.addMapLabel(city))
        })
    }

    addMapLabel(city) {
        const div = document.createElement('div')
        div.setAttribute('class', 'map-label-container position-absolute d-flex align-items-center justify-content-center')
        div.style.left = `${city['positionX']}px`
        div.style.top = `${city['positionY']}px`

        const label = document.createElement('div')
        label.setAttribute('class', 'map-label')
        label.innerHTML = city['name']

        const marker = document.createElement('div')
        marker.setAttribute('class', 'map-marker')
        marker.innerHTML = city['sensors'].length

        div.appendChild(label)
        div.appendChild(marker)

        return div
    }
}
