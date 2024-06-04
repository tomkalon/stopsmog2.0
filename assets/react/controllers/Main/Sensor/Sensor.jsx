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
        xAxis: [
            {
                scaleType: 'band',
                dataKey: 'hour',
                valueFormatter: (date) => date.getUTCHours().toString(),
                data: xLabels,
                label: 'Godzina',
                labelStyle: {
                    fontSize: 16,
                    fontWeight: 'bold',
                },
            }
        ],
        yAxis: [
            {
                label: 'Wartość PM10',
                labelStyle: {
                    fontSize: 16,
                    fontWeight: 'bold',
                },
                min: 0,
                colorMap: {
                    type: 'continuous',
                    min: 0,
                    max: 200,
                    color: ['green', 'red'],
                },
            },
        ],
        width: 900,
        height: 560,
        sx: {
            [`.${axisClasses.left}, .${axisClasses.label}`]: {
                transform: 'translate(-20px, 0)',
            },
        },
    };

    return (
        <Container>
            <Box display="flex">
                <BarChart
                    series={[{
                        data: xData,
                        label: 'PM10',
                        type: 'bar',
                        color: '#ffffff'
                    }]}
                    grid={{ horizontal: true }}
                    {...chartSetting}
                />
            </Box>
        </Container>
    );
}
