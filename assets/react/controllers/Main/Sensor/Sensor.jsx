import React from 'react';
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';


export default function (props) {
    return (
        <Container>
            <Row>
                <Col>
                    {console.log(props)}
                </Col>
            </Row>
        </Container>
    );
}
