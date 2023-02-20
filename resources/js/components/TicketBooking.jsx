import React, {useEffect, useState} from 'react';
import {createRoot} from 'react-dom/client';
import DatePick from './DatePick';
import SeatPick from "./SeatPick";
import TimePick from "./TimePick";
import TicketService from "../services/TicketService";

export default function TicketBooking(props) {
    useEffect(() => {
    }, []);

    const film = JSON.parse(props.data);
    const [timesData, setTimesData] = useState([]);
    const [seatsData, setSeatsData] = useState([]);
    const [selectedSeats, setSelectedSeats] = useState([]);

    const getTimes = (filmId, date) => {
        TicketService.getTimes(filmId, date).then(r => {
            if (r.success) {
                setTimesData(r.data);
            } else {
                console.log(r.message);
            }
        }).catch(e => console.log(e));
    };
    const getSeats = (roomId) => {
        TicketService.getSeats(roomId).then(r => {
            if (r.success) {
                setSeatsData(r.data);
            } else {
                console.log(r.message);
            }
        }).catch(e => console.log(e));
    };

    const getSeatInfo = (seatId) => {
        TicketService.getSeatInfo(seatId).then(r => {
            if (r.success) {
                console.log('Seat ID parameter put into GetSeatInfo API: ' + seatId)
                setSelectedSeats([...selectedSeats, r.data]);
            } else {
                console.log(r.message);
            }
        }).catch(e => console.log(e));
    }

    return (
        <>
                <h1>TicketBooking</h1>

                <h2>Which day you want to watch?</h2>
                <DatePick getTimes={getTimes} filmId={film.id}/>
                <TimePick timesData={timesData} getSeats={getSeats}/>
                <SeatPick seatsData={seatsData} pickedSeatsInfo={selectedSeats} getSeatInfo={getSeatInfo}/>
        </>

    );
}

if (document.getElementById('ticket_booking')) {
    let data = document.getElementById('ticket_booking').getAttribute('data');
    createRoot(document.getElementById('ticket_booking')).render(<TicketBooking data={data}/>);
}
