import * as React from 'react';
import Container from 'react-bootstrap/Container';
import Box from '@mui/material/Box';

import { axisClasses } from '@mui/x-charts/ChartsAxis';
import {BarChart} from '@mui/x-charts/BarChart';


export default function DayChart(props)
{
    const xData = []
    const xLabels = []

    props.data['hydra:member'].forEach((measurement) => {
        xData.push(measurement.pm10)
        xLabels.push(new Date(measurement.createdAt))
    })

    return (
        <Container>
            <Box display="flex">
                <BarChart
                    width={960}
                    height={500}
                    axisHighlight={{
                        x: 'line'
                        }}
                    xAxis={[{
                        scaleType: 'band',
                        valueFormatter: (date, context) =>
                            context.location === 'tick'
                            ? date.getUTCHours().toString()
                            : date.toLocaleString(),
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
                        () => ({
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
