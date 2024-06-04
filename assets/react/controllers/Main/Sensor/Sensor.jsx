import React, {useState, useEffect} from 'react';
import Api from '@Api';
import DayChart from "@ReactComponent/charts/DayChart";

export default function (props) {

    const [data, setData] = useState(null);

    const today = new Date();
    today.setHours(0, 0, 0);

    useEffect(() => {
        Api.get(
            'api_measurements_get',
            {
                sensor: props.sensor,
                // 'createdAt[after]': today.toISOString(),
                'createdAt[after]': "2024-05-23T00:00:00.000Z",
            },
            (data) => setData(data)
        )
    }, []);

    if (data) {
        return(<DayChart data={data}/>)
    }
}
