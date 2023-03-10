import React, {useEffect, useState} from 'react';
import {createRoot} from 'react-dom/client';
import DatePick from './DatePick';
import SeatPick from "./SeatPick";
import TimePick from "./TimePick";
import TicketService from "../services/TicketService";
import moment from "moment/moment";
import FilmService from "../services/FilmService";


export default function TicketBooking(props) {

    const urlSearchParams = new URLSearchParams(window.location.search);
    const queryParams = Object.fromEntries(urlSearchParams.entries());
    const filmId = queryParams.filmId;

    const [film, setFilm] = useState({});
    useEffect(() => {
        FilmService.getFilmInfo(queryParams.filmId).then(r => {
            setFilm(r.data);
        }).catch(e => {
            console.log(e);
        });
    }, [])

    const userId = JSON.parse(props.user) === null ? null : JSON.parse(props.user).id;

    const [dateState, setDateState] = useState('');
    const [timeState, setTimeState] = useState('');
    useEffect(() => {
        setSeatsData([]);
        setSeatInfos([]);
    }, [dateState, timeState]);

    const [timesData, setTimesData] = useState([]);
    const [seatsData, setSeatsData] = useState([]);
    const [seatInfos, setSeatInfos] = useState([]);

    const [payment, setPayment] = useState('');

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

    const handlePopup = () => {
        if (timeState === 'null' || seatInfos[0] === undefined) {
            alert('Please pick a time and seats first!');
        } else if (timeState === 'null' || seatInfos[0] === undefined) {
            alert('Please pick a time and seats first!');
        } else if (userId === null) {
            if (confirm('Please Login first!') === true) {
                window.location.href = `/signIn?filmId=${filmId}`;
            }
        } else {
            let popup = document.getElementById('confirmPopup');
            popup.classList.toggle('active');
        }
    };


    const handlePayment = (value) => {
        setPayment(value);
    }

    return (
        <div className="booking-sections">
            <div className="left-booking">
                <DatePick getTimes={getTimes} filmId={filmId} onData={handleDateState}/>
                <TimePick timesData={timesData} getSeats={getSeats} onData={handleTimeState}/>
                <SeatPick seatsData={seatsData} onData={handleNewSelectedSeat}/>
                <div className="total">
                </div>
            </div>

            <div className="right-booking">
                <img src={film.path} className="" alt="film image"></img>
                <h2 className="uk-text-contrast">{film.name}</h2>
                <div>showtime: {timeState.split(' ')[0]}</div>
                <div>seats: {seatInfos.map(seat => <span
                    key={`${seat.id}-${seat.name}`}>{seat.name} {" "}</span>)}</div>
                <span>number of tickets: {seatInfos.length}</span>{" "}
                <span>prices: {seatInfos.reduce((total, seat) => total + seat.price, 0)}</span>

                <hr/>
                <button className="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="button"
                        onClick={handlePopup}>Confirm
                </button>
            </div>
            <div id="confirmPopup">
                <h2>Confirm you booking information</h2>
                <div>showtime: {timeState.split(' ')[0]}</div>
                <div>seats: {seatInfos.map(seat => <span
                    key={`${seat.id}-${seat.name}`}>{seat.name} {" "}</span>)}</div>
                <span>number of tickets: {seatInfos.length}</span>{" "}
                <span> prices: {seatInfos.reduce((total, seat) => total + seat.price, 0)}</span>

                <h3>Payment method:</h3>
                <div>
                    <input type="radio" id="stripe" name="payment_method" value="stripe"
                           onChange={(e) => handlePayment(e.currentTarget.value)}></input>
                    <label htmlFor="stripe">Stripe</label>
                </div>

                <div>
                    <input type="radio" id="momo" name="payment_method" value="momo"
                           onChange={(e) => handlePayment(e.currentTarget.value)}></input>
                    <label htmlFor="momo">Momo</label>
                </div>
                <br/>
                <button onClick={() => handlePopup()}>cancel</button>
                <button onClick={() => handleSubmitConfirm()}>pay</button>
            </div>
        </div>
    );
}

if (document.getElementById('ticket_booking')) {
    let user = document.getElementById('ticket_booking').getAttribute('user');
    createRoot(document.getElementById('ticket_booking')).render(<TicketBooking user={user}/>);
}
