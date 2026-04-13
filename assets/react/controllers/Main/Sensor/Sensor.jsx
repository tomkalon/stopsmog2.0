import React, {useState, useEffect} from 'react';
import Api from '@Api';
import DayChart from "@ReactComponent/charts/DayChart";
import WeekChart from "@ReactComponent/charts/WeekChart";
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

    useEffect(() => {
        setData('init');

        try {
            if (page === 'day') {
                const today = new Date();
                today.setUTCHours(0, 0, 0, 0);
                Api.get(
                    'api_measurements_get',
                    {
                        sensor: props.sensor,
                        'createdAt[after]': today.toISOString(),
                        'createdAt[before]': null
                    },
                    (data) => setData(data)
                );
            } else {
                Api.get(
                    'api_measurements_weekly_get',
                    {sensor: props.sensor},
                    (data) => setData(data)
                );
            }
        } catch (e) {
            setData(null);
        }
    }, [page]);

    const hasData = data !== 'init' && (
        page === 'day'
            ? !!(data && data['hydra:totalItems'])
            : !!(data && data.items && data.items.length)
    );

    let component = null;
    if (data === 'init') {
        component = <Box className={"py-5"}>
            <p className={"text-center"}>
                {trans(UI_COMMON_LOADING)}
            </p>
            <Box display="flex" justifyContent={"center"}>
                <Spinner animation="grow"/>
            </Box>
        </Box>;
    } else if (hasData) {
        component = <Box className={"py-1"}>
            {page === 'day'
                ? <DayChart data={data}/>
                : <WeekChart data={data.items}/>
            }
        </Box>;
    } else {
        component = <Box>
            {trans(UI_COMMON_DATA_EMPTY)}
        </Box>;
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
                    <ToggleButton value="week" aria-label="right">
                        Tydzień
                    </ToggleButton>
                </ToggleButtonGroup>
            </Box>
            {component}
        </Container>
    );
}
