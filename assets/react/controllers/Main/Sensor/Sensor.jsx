import React, {useState, useEffect} from 'react';
import Api from '@Api';
import Container from 'react-bootstrap/Container';
import Box from '@mui/material/Box';

import { axisClasses } from '@mui/x-charts/ChartsAxis';
import {BarChart, BarPlot} from '@mui/x-charts/BarChart';

export default function (props) {

    const [data, setData] = useState(null);

    useEffect(() => {
        const today = new Date();
        today.setHours(0, 0, 0);

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


    const xData = []
    const xLabels = []

    if (data) {
        data['hydra:member'].forEach((measurement) => {
            xData.push(measurement.pm10)
            xLabels.push(new Date(measurement.createdAt))
        })
    }

    const chartSetting = {
        yAxis: [
            {
                label: 'Wartość PM10',
            },
        ],

        width: 900,
        height: 560,
        sx: {
            [`.${axisClasses.left} .${axisClasses.label}`]: {
                transform: 'translate(-20px, 0)',
            },
        },
    };

    return (
        <Container>
            <Box display="flex">
                <BarChart
                    width={960}
                    height={500}
                    xAxis={[{
                        scaleType: 'band',
                        dataKey: 'hour',
                        valueFormatter: (date) => date.getUTCHours().toString(),
                        data: xLabels,
                        label: "Godzina",
                        labelStyle: {
                            fontSize: 14,
                            fill: "black",
                            fontWeight: "bold",
                            fontFamily: "Poppins"
                        },

                    }]}
                    yAxis={[ {
                        min: 0,
                        label: "Wartość PM10",
                        labelStyle: {
                            fontSize: 14,
                            fill: "black",
                            fontWeight: "bold",
                            fontFamily: "Poppins"
                        },
                        colorMap: {
                            type: 'piecewise',
                            thresholds: [25, 50, 80, 110, 150],
                            colors: ['green', 'yellow', 'orange', 'red', '#aa1e1e',  'purple'],
                        },
                    }]}
                    sx={
                        (theme) => ({
                            [`.${axisClasses.left} .${axisClasses.label}`]: {
                                transform: 'translate(-10px, 0)',
                            },
                        })
                    }
                    series={[{
                        data: xData,
                        label: 'PM10',
                        type: 'bar',
                        color: '#ffffff'
                    }]}
                />
            </Box>
        </Container>
    );
}
