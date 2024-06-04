import React, {useState, useEffect} from 'react';
import Api from '@Api';
import Container from 'react-bootstrap/Container';
import Box from '@mui/material/Box';

import { ChartContainer } from '@mui/x-charts/ChartContainer';
import { ChartsReferenceLine } from '@mui/x-charts/ChartsReferenceLine';
import { ChartsXAxis } from '@mui/x-charts/ChartsXAxis';
import { ChartsYAxis } from '@mui/x-charts/ChartsYAxis';
import { LinePlot, MarkPlot } from '@mui/x-charts/LineChart';
import {hydrate} from "react-dom";

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

    return (
        <Container>
            <Box display="flex">
                <ChartContainer
                    width={960}
                    height={500}
                    series={[{
                        data: xData,
                        label: 'pm10',
                        type: 'line'
                    }]}
                    xAxis={[{
                        scaleType: 'utc',
                        valueFormatter: (date) => date.getUTCHours().toString(),
                        data: xLabels
                    }]}
                    yAxis={[ {
                        min: 0,
                        colorMap: {
                            type: 'piecewise',
                            thresholds: [0, 25, 50, 80, 110, 150],
                            colors: ['green', 'yellow', 'orange', 'red', 'burgundy',  'purple'],
                        }
                    }]}
                >
                    <MarkPlot />
                    <LinePlot />
                    <ChartsReferenceLine y={50} label="Norma" lineStyle={{ stroke: 'red', strokeDasharray: '10 5'  }} />
                    <ChartsXAxis />
                    <ChartsYAxis />
                </ChartContainer>
            </Box>
        </Container>
    );
}
