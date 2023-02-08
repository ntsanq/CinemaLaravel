import React, {useEffect} from 'react';
import {createRoot} from 'react-dom/client';
import DatePick from './DatePick';
import SeatPick from "./SeatPick";
import TimePick from "./TimePick";

export default function TicketBooking(props) {
    useEffect(() => {
        console.log(props.data)
    }, []);
    return (
        <>
            <pre>
                {props.data}
            </pre>

            <h1>TicketBooking</h1>

            <h2>Which day you want to watch?</h2>
            <DatePick/>
            <TimePick/>
            <SeatPick/>
        </>

    );
}

if (document.getElementById('ticket_booking')) {
    let data = document.getElementById('ticket_booking').getAttribute('data');
    createRoot(document.getElementById('ticket_booking')).render(<TicketBooking data={data}/>);
}
