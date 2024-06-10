import React, {useState, useEffect} from 'react';
import Api from '@Api';
import DayChart from "@ReactComponent/charts/DayChart";
import Container from "react-bootstrap/Container";
import Box from '@mui/material/Box';

import Spinner from 'react-bootstrap/Spinner';

export default function (props) {

    const [data, setData] = useState('init');

    const today = new Date();
    today.setUTCHours(0, 0, 0);

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
        return (<DayChart data={data}/>)
    } else if (data === 'init') {
        return (
            <Container>
                <Box display="flex" justifyContent={"center"}>
                    <Spinner animation="grow"/>
                </Box>
            </Container>
        )
    } else {
        return (
            <Container>
                Brak danych do wyświetlenia.
            </Container>
        )
    }
}
