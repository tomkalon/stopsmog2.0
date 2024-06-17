const DataMaker = (measurements, yMax = 100) => {
    const data = []

    measurements.forEach((measurement, key) => {
        const hour = new Date(measurement.createdAt)
        data[key] = {
            "label": hour.getHours(), "value": measurement.pm10
        }

        if (measurement.pm10 > yMax) {
            yMax = null
        }
    })

    const outputArray = Array.from({length: 24}, (_, i) => {
        const matchingObjects = data.filter(obj => obj.label === i);
        if (matchingObjects.length === 0) {
            return {label: i, value: null};
        } else {
            const totalValue = matchingObjects.reduce((sum, obj) => sum + obj.value, 0);
            const averageValue = totalValue / matchingObjects.length;
            const roundedValue = averageValue !== null ? Math.round(averageValue) : null;
            return {label: i, value: roundedValue};
        }
    });

    const result = {
        label: outputArray.map(item => item.label), value: outputArray.map(item => item.value)
    };

    return {
        "data": result, "yMax": yMax
    }
}

export {DataMaker}
