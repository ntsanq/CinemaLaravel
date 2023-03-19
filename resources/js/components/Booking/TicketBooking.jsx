import React, {useEffect, useState} from 'react';
import {createRoot} from 'react-dom/client';
import DatePick from './DatePick';
import SeatPick from "./SeatPick";
import TimePick from "./TimePick";
import TicketService from "../../services/TicketService";
import moment from "moment/moment";
import FilmService from "../../services/FilmService";
import BookingDetails from "./BookingDetails";

export default function TicketBooking(props) {

    const urlSearchParams = new URLSearchParams(window.location.search);
    const queryParams = Object.fromEntries(urlSearchParams.entries());
    const filmId = queryParams.filmId;
    const [film, setFilm] = useState({});
    const userId = JSON.parse(props.user) === null ? null : JSON.parse(props.user).id;

    const [dateState, setDateState] = useState('');
    const [timeState, setTimeState] = useState('');

    const [timesData, setTimesData] = useState([]);
    const [seatsData, setSeatsData] = useState([]);
    const [seatInfos, setSeatInfos] = useState([]);
    const [payment, setPayment] = useState('');
    const [popUpOpen, setPopUpOpen] = useState(false);

    useEffect(() => {
        FilmService.getFilmInfo(queryParams.filmId).then(r => {
            setFilm(r.data);
        }).catch(e => {
            console.log(e);
        });
    }, [])

    useEffect(() => {
        setSeatsData([]);
        setSeatInfos([]);
    }, [dateState, timeState]);

    const getTimes = (filmId, date) => {
        TicketService.getTimes(filmId, date).then(r => {
            setTimesData(r.data);
        }).catch(e => {
            console.log(e);
        });
    };
    const getSeats = (roomId) => {
        TicketService.getSeats(roomId).then(r => {
            setSeatsData(r.data);
        }).catch(e => console.log(e));
    };

    const getSeatInfo = (seatId) => {
        TicketService.getSeatInfo(seatId).then(r => {
            const newSeatNameIndex = seatInfos.indexOf(r.data.name);
            if (newSeatNameIndex === -1) {
                const object = {
                    id: r.data.id,
                    name: r.data.name,
                    price: r.data.price
                }
                setSeatInfos([...seatInfos, object]);
            }

        }).catch(e => console.log(e));
    }

    const confirmBooking = (filmId, scheduleTime, seats, discountId, userId, payment) => {
        TicketService.book(filmId, scheduleTime, seats, discountId, userId, payment).then(r => {
            console.log(r.data)
            window.location.href = r.data;
        }).catch(function (error) {

        });
    }

    const handleDateState = (date) => {
        setDateState(date);
    }
    const handleTimeState = (time) => {
        setTimeState(time);
    }
    const handleNewSelectedSeat = (seatId) => {
        const seatWithId = seatInfos.find(seat => seat.id === seatId);
        if (seatWithId) {
            const newArray = seatInfos.filter(seat => seat.id !== seatId);
            setSeatInfos(newArray);
        } else {
            getSeatInfo(seatId);
        }
    }

    const handleSubmitConfirm = () => {
        if (payment === '') {
            alert('Please choose your payment!');
        }
        const timeButtonContent = timeState.split(' ');
        let scheduleTime = moment(dateState).format('DD-MM-YYYY') + ' ' + timeButtonContent[0];
        const seatsArray = seatInfos.map(seat => seat.id);
        confirmBooking(filmId, scheduleTime, seatsArray, 1, userId, payment);
    }

    const handleEnoughInfo = () => {
        if (timeState === 'null' || seatInfos[0] === undefined) {
            alert('Please pick a time and seats first!');
        } else if (timeState === 'null' || seatInfos[0] === undefined) {
            alert('Please pick a time and seats first!');
        } else if (userId === null) {
            if (confirm('Please Login first!') === true) {
                window.location.href = `/signIn?filmId=${filmId}`;
            }
        } else {
            setPopUpOpen(true);
        }
    };

    const handlePopUp = (bool) => {
        setPopUpOpen(bool);
    }

    const handlePayment = (value) => {
        setPayment(value);
    }

    return (
        <div className="booking-sections">
            <div className="left-booking">
                <DatePick getTimes={getTimes} filmId={filmId} onData={handleDateState}/>
                <TimePick timesData={timesData} getSeats={getSeats} onData={handleTimeState}/>
                <SeatPick seatsData={seatsData} onData={handleNewSelectedSeat}/>
            </div>

            <div className="right-booking">
                <BookingDetails film={film} timeState={timeState} seatInfos={seatInfos}
                                handleEnoughInfo={handleEnoughInfo}
                                handleSubmitConfirm={handleSubmitConfirm} popUpOpen={popUpOpen}
                                onPopUpData={handlePopUp}
                                handelPayment={handlePayment}/>
            </div>
        </div>
    );
}

if (document.getElementById('ticket_booking')) {
    let user = document.getElementById('ticket_booking').getAttribute('user');
    createRoot(document.getElementById('ticket_booking')).render(<TicketBooking user={user}/>);
}
