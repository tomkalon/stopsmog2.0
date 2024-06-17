import * as React from 'react';
import Container from 'react-bootstrap/Container';
import Box from '@mui/material/Box';

import {DataMaker} from '../charts/misc/DataMaker';

import {axisClasses} from '@mui/x-charts/ChartsAxis';
import {BarChart} from '@mui/x-charts/BarChart';
import {ChartsReferenceLine} from '@mui/x-charts/ChartsReferenceLine';

import {
    trans,
    UI_MEASUREMENT_HOUR, UI_MEASUREMENT_DATE, UI_MEASUREMENT_PM10VALUE, UI_MEASUREMENT_NORM
} from '@Translator';

export default function DayChart(props) {
    const xData = []
    const xLabels = []
    let yMax = 100

    let data = {}

    props.data['hydra:member'].forEach((measurement) => {
        xData.push(measurement.pm10)
        xLabels.push(new Date(measurement.createdAt))
        if (measurement.pm10 >= 100) {
            yMax = null
        }
    })

    const today = new Date()
    let currentDay = today.getUTCFullYear() + '.' + (today.getUTCMonth() + 1) + '.' + (today.getUTCDate())

    while (xLabels.length < 24) {
        const length = xLabels.length
        const hour = new Date(today);
        hour.setUTCHours(length);
        hour.setMinutes(0);
        hour.setSeconds(0);
        xLabels.push(hour);
    }

    if (props.data['hydra:member']) {
        data = DataMaker(props.data['hydra:member'])
    }

    return (
        <Box display="flex">
            <BarChart
                height={500}
                axisHighlight={{
                    x: 'line'
                }}
                grid={{horizontal: true}}
                borderRadius={3}
                tooltip={{trigger: 'item'}}
                xAxis={[{
                    scaleType: 'band',
                    categoryGapRatio: -0.05,
                    barGapRatio: 0,
                    valueFormatter: (date, context) => date.toString(),
                    data: data.data.label,
                    label: trans(UI_MEASUREMENT_HOUR) + ' | ' + trans(UI_MEASUREMENT_DATE) + ': ' + currentDay,
                    labelStyle: {
                        fontSize: 14,
                        fill: "black",
                        fontWeight: "bold",
                        fontFamily: "Poppins"
                    },
                }]}
                yAxis={[{
                    min: 0,
                    max: data['yMax'],
                    label: trans(UI_MEASUREMENT_PM10VALUE),
                    labelStyle: {
                        fontSize: 14,
                        fill: "black",
                        fontWeight: "bold",
                        fontFamily: "Poppins"
                    },
                    colorMap: {
                        type: 'piecewise',
                        thresholds: [25, 50, 80, 110, 150],
                        colors: ['green', '#d8ff00', '#ffc000', 'red', '#aa1e1e', 'purple'],
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
                    data: data.data.value,
                    label: 'PM10',
                    type: 'bar',
                    color: '#ffffff'
                }]}
            >
                <ChartsReferenceLine y={50}
                                     label={trans(UI_MEASUREMENT_NORM)}
                                     labelAlign="end"
                                     labelStyle={{
                                         fontSize: 12,
                                         fontWeight: "bold",
                                         fill: "#ff0000"
                                     }}
                                     lineStyle={{stroke: 'red', strokeDasharray: '10 5'}}
                />
            </BarChart>
        </Box>
    );
}
