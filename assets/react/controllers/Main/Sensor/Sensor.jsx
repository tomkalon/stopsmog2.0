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

import {ToggleButton, ToggleButtonGroup} from "@mui/material";

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
                'createdAt[before]': null
            },
            (data) => setData(data)
        )
    }, [page]);

    let component = null
    if (data && data['hydra:totalItems']) {
        if (page === 'day') {
            component = <Box className={"py-1"}>
                <DayChart data={data}/>
            </Box>
        }
    } else if (data === 'init') {
        component = <Box className={"py-5"}>
            <p className={"text-center"}>
                {trans(UI_COMMON_LOADING)}
            </p>
            <Box display="flex" justifyContent={"center"}>
                <Spinner animation="grow"/>
            </Box>
        </Box>
    } else {
        component = <Box>
            {trans(UI_COMMON_DATA_EMPTY)}
        </Box>
    }

    const handlePage = (event, newPage) => {
        if (newPage !== null) {
            setPage(newPage);
        }
    };
    return (
        <Container>
            <Box display={"flex"} justifyContent={"center"}>
                <ToggleButtonGroup
                    value={page}
                    exclusive
                    onChange={handlePage}
                    aria-label="text alignment"
                >
                    <ToggleButton value="day" aria-label="left aligned">
                        Dzień
                    </ToggleButton>
                    <ToggleButton value="week" aria-label="right" disabled>
                        Tydzień
                    </ToggleButton>

                </ToggleButtonGroup>
            </Box>
            {component}
        </Container>
    )
}
