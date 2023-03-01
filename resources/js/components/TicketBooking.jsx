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

    console.log(film);
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
                Object.keys(messages).forEach(key => {
                    if (key === 'userId') {
                        if (confirm('Please Login first!') === true) {
                            window.location.href = '/signIn';
                        }
                    }
                    if (key === 'seats' || key === 'scheduleTime') {
                        alert('Please pick a time and seats first!')
                    }
                    if (key === 'filmId') {
                        alert('This film may not available!')
                    }
                });
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

    return (
        <>
            <div className="left-booking">
                {loadingSection.first ?
                    <DatePick getTimes={getTimes} filmId={filmId} onData={handleDateState}/> : null}

                {loadingSection.second ?
                    <TimePick timesData={timesData} getSeats={getSeats} onData={handleTimeState}/> : null}

                {loadingSection.third ?
                    <>
                        <SeatPick seatsData={seatsData} onData={handleNewSelectedSeat}/>

                        <form className="uk-panel uk-panel-box uk-form">
                            <input className="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="button"
                                   value="Confirm" onClick={handleSubmitConfirm}/>
                        </form>
                    </>
                    : null}

                <div className="total">
                    <span>Seats Count: {seatInfos.length}</span>{" "}
                    <span> Total: {seatInfos.reduce((total, seat) => total + seat.price, 0)}</span>
                    <span>You selected: {seatInfos.map(seat => <span
                        key={`${seat.id}-${seat.name}`}>{seat.name}</span>)}</span>
                </div>
            </div>
            <div className="right-info">
                <div>Name: {film.description}</div>
                <div>Description: {film.description}</div>
            </div>
        </>
    );
}

if (document.getElementById('ticket_booking')) {
    let film = document.getElementById('ticket_booking').getAttribute('film');
    let user = document.getElementById('ticket_booking').getAttribute('user');
    createRoot(document.getElementById('ticket_booking')).render(<TicketBooking film={film} user={user}/>);
}
