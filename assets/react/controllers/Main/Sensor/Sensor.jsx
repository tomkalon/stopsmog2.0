import React, { useState, useEffect } from 'react';
import Api from '@Api';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';

export default function (props) {

    const [data, setData] = useState(null);

    useEffect(() => {
        const today = new Date();
        today.setHours(0, 0, 0);

        Api.get(
            'api_measurements_get',
            {
                sensor: props.sensor,
                'createdAt[after]': today.toISOString(),
            },
            (data) => setData(data)
        )
    }, []);

    return (
        <Container>
            <Row>
                <Col>
                    {data ? JSON.stringify(data) : 'Loading...'}
                </Col>
            </Row>
        </Container>
    );
}
