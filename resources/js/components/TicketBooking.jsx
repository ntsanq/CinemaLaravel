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

    const [loadingSection, setLoadingSection] = useState({first: true, second: false, third: false});

    const getTimes = (filmId, date) => {
        TicketService.getTimes(filmId, date).then(r => {
            setTimesData(r.data);
            if (r.data[0]) {
                const newLoadingSection = {...loadingSection, ...{second: true}};
                setLoadingSection(newLoadingSection);
            }
        }).catch(e => {
            console.log(e);
        });
    };
    const getSeats = (roomId) => {
        TicketService.getSeats(roomId).then(r => {
            setSeatsData(r.data);
            if (r.data) {
                const newLoadingSection = {...loadingSection, ...{third: true}};
                setLoadingSection(newLoadingSection);
            }
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

    const confirmBooking = (filmId, scheduleTime, seats, discountId, userId) => {
        TicketService.book(filmId, scheduleTime, seats, discountId, userId).then(r => {
            let ids = [];
            Object.keys(r.data).forEach(key => {
                ids = [...ids, r.data[key].id]
            })
            window.location.href = `/ticket/receipt?tickets=[${ids}]`;
        }).catch(function (error) {
            if (error.response) {
                const messages = error.response.data.message;
                if (Object.keys(messages) && Object.keys(messages)[0] === 'userId') {
                    if (confirm('Please Login first!') === true) {
                        window.location.href = '/signIn';
                    }
                }
                if (Object.keys(messages) && Object.keys(messages)[0] === 'filmId') {
                    alert('This film may not available!')
                }
                if (Object.keys(messages) && Object.keys(messages)[0] === 'scheduleTime') {
                    alert('Please pick a time and seats first!')
                }
                if (Object.keys(messages) && Object.keys(messages)[0] === 'seats') {
                    alert('Please pick a time and seats first!')
                }
            }
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
        const timeButtonContent = timeState.split(' ');
        let scheduleTime = moment(dateState).format('DD-MM-YYYY') + ' ' + timeButtonContent[0];
        const seatsArray = seatInfos.map(seat => seat.id);
        confirmBooking(filmId, scheduleTime, seatsArray, 1, userId);
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
