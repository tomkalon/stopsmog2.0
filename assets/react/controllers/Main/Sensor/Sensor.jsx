import React, {useState, useEffect} from 'react';
import Api from '@Api';
import DayChart from "@ReactComponent/charts/DayChart";
import Container from "react-bootstrap/Container";

export default function (props) {

    const [data, setData] = useState(null);

    const today = new Date();
    today.setHours(0, 0, 0);

    useEffect(() => {
        Api.get(
            'api_measurements_get',
            {
                sensor: props.sensor,
                'createdAt[after]': today.toISOString(),
            },
            (data) => setData(data)
        )
    }, []);

    if (data && data['hydra:totalItems']) {
        return(<DayChart data={data}/>)
    } else {
        return(
            <Container>
                Brak danych do wyświetlenia.
            </Container>
        )
    }
}
