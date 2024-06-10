import React, {useState, useEffect} from 'react';
import Api from '@Api';
import DayChart from "@ReactComponent/charts/DayChart";
import Container from "react-bootstrap/Container";
import Box from '@mui/material/Box';
import Spinner from 'react-bootstrap/Spinner';

import {
    trans,
    UI_COMMON_LOADING, UI_COMMON_DATA_EMPTY
} from '@Translator';

export default function (props) {

    const [data, setData] = useState('init');
    const [page, setPage] = useState('day');

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


    let component = null
    if (data && data['hydra:totalItems']) {
        if (page === 'day') {
            component = <Container className={"py-1"}>
                <DayChart data={data}/>
            </Container>
        }
    } else if (data === 'init') {
        component = <Container className={"py-5"}>
            <p className={"text-center"}>
                {trans(UI_COMMON_LOADING)}
            </p>
            <Box display="flex" justifyContent={"center"}>
                <Spinner animation="grow"/>
            </Box>
        </Container>
    } else {
        component = <Container>
            {trans(UI_COMMON_DATA_EMPTY)}
        </Container>
    }

    return (component)
}
