import * as React from 'react';
import Box from '@mui/material/Box';

import {axisClasses} from '@mui/x-charts/ChartsAxis';
import {BarChart} from '@mui/x-charts/BarChart';
import {ChartsReferenceLine} from '@mui/x-charts/ChartsReferenceLine';

import {
    trans,
    UI_MEASUREMENT_PM10VALUE, UI_MEASUREMENT_NORM
} from '@Translator';

const DAY_NAMES = ['niedz', 'pon', 'wt', 'śr', 'czw', 'pt', 'sob'];

export default function WeekChart(props) {
    const labels = [];
    const values = [];
    let yMax = 100;

    props.data.forEach((measurement) => {
        const date = new Date(measurement.createdAt);
        const dayName = DAY_NAMES[date.getDay()];
        const hour = String(date.getHours()).padStart(2, '0');
        labels.push(dayName + ' ' + hour + ':00');

        const pm10 = measurement.pm10 !== null ? Number(measurement.pm10) : null;
        values.push(pm10);

        if (pm10 !== null && pm10 >= 100) {
            yMax = null;
        }
    });

    return (
        <Box display="flex">
            <BarChart
                height={500}
                axisHighlight={{x: 'line'}}
                grid={{horizontal: true}}
                borderRadius={3}
                tooltip={{trigger: 'item'}}
                xAxis={[{
                    scaleType: 'band',
                    categoryGapRatio: -0.05,
                    barGapRatio: 0,
                    data: labels,
                    labelStyle: {
                        fontSize: 12,
                        fill: 'black',
                        fontWeight: 'bold',
                        fontFamily: 'Poppins',
                    },
                    tickLabelStyle: {
                        angle: -45,
                        textAnchor: 'end',
                        fontSize: 10,
                    },
                }]}
                yAxis={[{
                    min: 0,
                    max: yMax,
                    label: trans(UI_MEASUREMENT_PM10VALUE),
                    labelStyle: {
                        fontSize: 14,
                        fill: 'black',
                        fontWeight: 'bold',
                        fontFamily: 'Poppins',
                    },
                    colorMap: {
                        type: 'piecewise',
                        thresholds: [25, 50, 80, 110, 150],
                        colors: ['green', '#d8ff00', '#ffc000', 'red', '#aa1e1e', 'purple'],
                    },
                }]}
                sx={() => ({
                    [`.${axisClasses.left} .${axisClasses.label}`]: {
                        transform: 'translate(-10px, 0)',
                    },
                })}
                series={[{
                    data: values,
                    label: 'PM10',
                    type: 'bar',
                    color: '#ffffff',
                }]}
            >
                <ChartsReferenceLine
                    y={50}
                    label={trans(UI_MEASUREMENT_NORM)}
                    labelAlign="end"
                    labelStyle={{fontSize: 12, fontWeight: 'bold', fill: '#ff0000'}}
                    lineStyle={{stroke: 'red', strokeDasharray: '10 5'}}
                />
            </BarChart>
        </Box>
    );
}
