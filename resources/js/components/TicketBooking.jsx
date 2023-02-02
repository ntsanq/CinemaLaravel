import React from 'react';
import { createRoot } from 'react-dom/client';
import DatePick from './DatePick';
import SeatPick from "./SeatPick";
import TimePick from "./TimePick";

export default function TicketBooking(){
    return(
        <>
            <h1>TicketBooking</h1>

            <h2 >Which day you want to watch?</h2>
            <DatePick />
            <TimePick />
            <SeatPick />
        </>

    );
}

if(document.getElementById('ticket_booking')){
    createRoot(document.getElementById('ticket_booking')).render(<TicketBooking />)
}
