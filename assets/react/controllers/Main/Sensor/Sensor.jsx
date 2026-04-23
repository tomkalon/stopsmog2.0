import React, {useState, useEffect} from 'react';
import Api from '@Api';
import DayChart from "@ReactComponent/charts/DayChart";
import WeekChart from "@ReactComponent/charts/WeekChart";
import MonthChart from "@ReactComponent/charts/MonthChart";
import RangeChart from "@ReactComponent/charts/RangeChart";
import Container from "react-bootstrap/Container";
import Box from '@mui/material/Box';
import Spinner from 'react-bootstrap/Spinner';
import {ToggleButton, ToggleButtonGroup, TextField, Button} from "@mui/material";

import {
    trans,
    UI_COMMON_LOADING, UI_COMMON_DATA_EMPTY
} from '@Translator';

function todayStr() {
    return new Date().toISOString().slice(0, 10);
}

function daysAgoStr(n) {
    const d = new Date();
    d.setDate(d.getDate() - n);
    return d.toISOString().slice(0, 10);
}

export default function (props) {

    const [data, setData] = useState('init');
    const [page, setPage] = useState('day');

    const [rangeFrom, setRangeFrom] = useState(daysAgoStr(30));
    const [rangeTo, setRangeTo]     = useState(todayStr());
    const [rangeGranularity, setRangeGranularity] = useState(null);
    const [rangePending, setRangePending] = useState(false);

    const fetchRange = () => {
        setData('init');
        setRangeGranularity(null);
        Api.get(
            'api_measurements_range_get',
            {sensor: props.sensor, from: rangeFrom, to: rangeTo},
            (resp) => {
                setRangeGranularity(resp.granularity);
                setData(resp);
            }
        );
    };

    useEffect(() => {
        if (page === 'range') {
            return;
        }

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
            } else if (page === 'week') {
                Api.get(
                    'api_measurements_weekly_get',
                    {sensor: props.sensor},
                    (data) => setData(data)
                );
            } else {
                Api.get(
                    'api_measurements_monthly_get',
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
    if (page === 'range') {
        if (data === 'init' && !rangePending) {
            component = (
                <Box className={"py-3"} display={"flex"} justifyContent={"center"}>
                    <Box color={"text.secondary"}>Wybierz zakres dat i naciśnij "Pokaż".</Box>
                </Box>
            );
        } else if (data === 'init') {
            component = (
                <Box className={"py-5"}>
                    <p className={"text-center"}>{trans(UI_COMMON_LOADING)}</p>
                    <Box display="flex" justifyContent={"center"}>
                        <Spinner animation="grow"/>
                    </Box>
                </Box>
            );
        } else if (hasData) {
            component = (
                <Box className={"py-1"}>
                    <RangeChart data={data.items} granularity={rangeGranularity}/>
                </Box>
            );
        } else {
            component = <Box>{trans(UI_COMMON_DATA_EMPTY)}</Box>;
        }
    } else if (data === 'init') {
        component = (
            <Box className={"py-5"}>
                <p className={"text-center"}>{trans(UI_COMMON_LOADING)}</p>
                <Box display="flex" justifyContent={"center"}>
                    <Spinner animation="grow"/>
                </Box>
            </Box>
        );
    } else if (hasData) {
        component = (
            <Box className={"py-1"}>
                {page === 'day'   && <DayChart data={data}/>}
                {page === 'week'  && <WeekChart data={data.items}/>}
                {page === 'month' && <MonthChart data={data.items}/>}
            </Box>
        );
    } else {
        component = <Box>{trans(UI_COMMON_DATA_EMPTY)}</Box>;
    }

    const handlePage = (event, newPage) => {
        if (newPage !== null) {
            setRangePending(false);
            setPage(newPage);
            if (newPage !== 'range') {
                setData('init');
            }
        }
    };

    const handleRangeSubmit = () => {
        setRangePending(true);
        fetchRange();
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
                    <ToggleButton value="month" aria-label="right">
                        Miesiąc
                    </ToggleButton>
                    <ToggleButton value="range" aria-label="right">
                        Zakres
                    </ToggleButton>
                </ToggleButtonGroup>
            </Box>

            {page === 'range' && (
                <Box display={"flex"} justifyContent={"center"} alignItems={"center"} gap={2} mt={2} flexWrap={"wrap"}>
                    <TextField
                        label="Od"
                        type="date"
                        size="small"
                        value={rangeFrom}
                        onChange={(e) => setRangeFrom(e.target.value)}
                        inputProps={{max: rangeTo}}
                        InputLabelProps={{shrink: true}}
                    />
                    <TextField
                        label="Do"
                        type="date"
                        size="small"
                        value={rangeTo}
                        onChange={(e) => setRangeTo(e.target.value)}
                        inputProps={{min: rangeFrom, max: todayStr()}}
                        InputLabelProps={{shrink: true}}
                    />
                    <Button variant="contained" onClick={handleRangeSubmit}>
                        Pokaż
                    </Button>
                </Box>
            )}

            {component}
        </Container>
    );
}
