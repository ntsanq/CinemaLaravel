import React, {useEffect, useState} from 'react';
import {createRoot} from 'react-dom/client';
import DatePick from './DatePick';
import SeatPick from "./SeatPick";
import TimePick from "./TimePick";
import TicketService from "../services/TicketService";
import moment from "moment/moment";

export default function TicketBooking(props) {
    useEffect(() => {
    }, []);

    const film = JSON.parse(props.film)
    const userId = JSON.parse(props.user) === null ? null : JSON.parse(props.user).id;

    const [dateState, setDateState] = useState('');
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
                setSelectedSeats([...selectedSeats, r.data.id]);
            } else {
                console.log(r.message);
            }
        }).catch(e => console.log(e));
    }


    const confirmBooking = (filmId, scheduleTime, seats, discountId, userId) => {
        TicketService.book(filmId, scheduleTime, seats, discountId, userId).then(r => {
            console.log(r)
            if (r.success) {
                console.log('Book api: ')
                console.log(r.data)
            }
        }) .catch(function (error) {
            if (error.response) {
                const messages = error.response.data.message;
                Object.keys(messages).forEach(key => {
                    messages[key].forEach(msg => {
                        alert(msg)
                    });
                });
            }
        });
    }

    const handleDateState = (date) => {
        setDateState(date);
    }

    const handleSubmitConfirm = () => {
        console.log('Submit: ');

        console.log('Selected time: ');
        let time = timesData[0] === undefined ? [] : timesData[0].start;
        let scheduleTime = moment(dateState).format('DD-MM-YYYY') + ' ' + time;
        console.log(scheduleTime);

        console.log('Selected seats: ');
        console.log(selectedSeats);

        console.log('User id: ');
        console.log(userId);

        confirmBooking(film.id, scheduleTime, selectedSeats, 1, userId);
    }

    return (
        <>
            <h1>TicketBooking</h1>
            <DatePick getTimes={getTimes} filmId={film.id} onData={handleDateState}/>
            <TimePick timesData={timesData} getSeats={getSeats}/>
            <SeatPick seatsData={seatsData} pickedSeatsInfo={selectedSeats} getSeatInfo={getSeatInfo}/>
            <form className="uk-panel uk-panel-box uk-form">
                <input className="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="button"
                       value="Confirm" onClick={handleSubmitConfirm}/>
            </form>
        </>

    );
}

if (document.getElementById('ticket_booking')) {
    let film = document.getElementById('ticket_booking').getAttribute('film');
    let user = document.getElementById('ticket_booking').getAttribute('user');
    createRoot(document.getElementById('ticket_booking')).render(<TicketBooking film={film} user={user}/>);
}
