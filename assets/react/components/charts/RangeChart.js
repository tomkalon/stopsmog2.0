import * as React from 'react';
import Box from '@mui/material/Box';

import {axisClasses} from '@mui/x-charts/ChartsAxis';
import {LineChart} from '@mui/x-charts/LineChart';
import {ChartsReferenceLine} from '@mui/x-charts/ChartsReferenceLine';

import {
    trans,
    UI_MEASUREMENT_PM10VALUE, UI_MEASUREMENT_NORM
} from '@Translator';

const DAY_NAMES = ['niedz', 'pon', 'wt', 'śr', 'czw', 'pt', 'sob'];
const MONTH_NAMES = ['sty', 'lut', 'mar', 'kwi', 'maj', 'cze', 'lip', 'sie', 'wrz', 'paź', 'lis', 'gru'];

function formatLabel(dateStr, granularity) {
    const date = new Date(dateStr);
    const day = date.getDate();
    const month = MONTH_NAMES[date.getMonth()];
    const dayName = DAY_NAMES[date.getDay()];
    const hour = String(date.getHours()).padStart(2, '0');

    if (granularity === '1h' || granularity === '4h') {
        return `${dayName} ${day} ${hour}:00`;
    }
    if (granularity === '1w') {
        return `${day} ${month}`;
    }
    return `${day} ${month}`;
}

export default function RangeChart({data, granularity}) {
    const labels = [];
    const values = [];
    let yMax = 100;

    data.forEach((measurement) => {
        labels.push(formatLabel(measurement.createdAt, granularity));

        const pm10 = measurement.pm10 !== null ? Number(measurement.pm10) : null;
        values.push(pm10);

        if (pm10 !== null && pm10 >= 100) {
            yMax = null;
        }
    });

    const tickInterval = Math.max(1, Math.floor(labels.length / 12));
    const visibleLabels = labels.map((l, i) => (i % tickInterval === 0 ? l : ''));

    return (
        <Box display="flex">
            <LineChart
                height={500}
                axisHighlight={{x: 'line'}}
                grid={{horizontal: true}}
                tooltip={{trigger: 'item'}}
                xAxis={[{
                    scaleType: 'band',
                    data: labels,
                    valueFormatter: (v, ctx) => {
                        if (ctx.location === 'tick') {
                            const idx = labels.indexOf(v);
                            return idx % tickInterval === 0 ? v : '';
                        }
                        return v;
                    },
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
                }]}
                sx={() => ({
                    [`.${axisClasses.left} .${axisClasses.label}`]: {
                        transform: 'translate(-10px, 0)',
                    },
                })}
                series={[{
                    data: values,
                    label: 'PM10',
                    type: 'line',
                    area: true,
                    curve: 'monotoneX',
                    color: '#1976d2',
                    showMark: data.length <= 60,
                }]}
            >
                <ChartsReferenceLine
                    y={50}
                    label={trans(UI_MEASUREMENT_NORM)}
                    labelAlign="end"
                    labelStyle={{fontSize: 12, fontWeight: 'bold', fill: '#ff0000'}}
                    lineStyle={{stroke: 'red', strokeDasharray: '10 5'}}
                />
            </LineChart>
        </Box>
    );
}
