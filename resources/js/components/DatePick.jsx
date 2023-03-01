import React, {useEffect, useState} from 'react';
import Calendar from "react-calendar";
// import 'react-calendar/dist/Calendar.css';
import moment from 'moment';
import Loading from "./Loading";

import styled from 'styled-components';

const CalendarContainer = styled.div`
    /* ~~~ container styles ~~~ */
    margin: 20px auto auto;
    background-color: #252527;
    padding: 20px 20px;
    max-height: 300px;
    width: 80%;

    border-radius: 3px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, .3);

    abbr[title] {
        text-decoration: none;
        border-bottom: none;
    }

    /* ~~~ navigation styles ~~~ */

    .react-calendar__navigation {
        display: flex;
        margin-bottom: 5px;

        .react-calendar__navigation__label {
            color: black;
            font-weight: bold;
            font-size: 18px;
            padding-top: 5px;
            padding-bottom: 5px;
            margin-left: 50px;
            margin-right: 50px;
        }

        .react-calendar__navigation__arrow {
            flex-grow: 0.333;
        }
    }


    /* ~~~ label styles ~~~ */

    .react-calendar__month-view__weekdays {
        text-align: center;
        color: #9b9b9b;
    }

    button {
        margin: 3px;
        background-color: #e1dddd;
        border: 0;
        border-radius: 3px;
        color: black;
        padding: 5px 0;

        &:hover {
            font-weight: bold;
            background-color: #e8b6b6;
            color: #232323;
        }

        &:active {
            background-color: #a7a8a9;
        }
    }

    /* ~~~ day grid styles ~~~ */

    .react-calendar__month-view__days {
        display: grid !important;
        grid-template-columns: 14.2% 14.2% 14.2% 14.2% 14.2% 14.2% 14.2%;

        .react-calendar__tile {
            max-width: initial !important;
        }
    }

    /* ~~~ neighboring month & weekend styles ~~~ */

    .react-calendar__month-view__days__day--neighboringMonth {
        opacity: 0.6;
    }

    .react-calendar__month-view__days__day--weekend {
        color: #9d2626;
    }

    /* ~~~ active day styles ~~~ */

    .react-calendar__tile--range {
        box-shadow: 0 0 6px 2px black;
        color: #ffffff;
        background-color: #d5302e;
    }
`;

export default function DatePick(props) {
    const getTimes = props.getTimes;
    const filmId = props.filmId;

    const [dateState, setDateState] = useState(new Date())
    const [loading, setLoading] = useState(true);


    useEffect(() => {
        setTimeout(() => {
            setLoading(false)
        }, 700)
    }, [])

    useEffect(() => {
        getTimes(filmId, moment(dateState).format('DD-MM-YYYY'));
        props.onData(dateState);
    }, [dateState])

    const changeDate = (e) => {
        setDateState(e);
        props.onData(e);
    }

    return (
        <>
            {
                loading ? <Loading/> :
                    <>
                        <h1>Choose your date</h1>
                        <CalendarContainer>
                            <Calendar
                                value={dateState}
                                onChange={changeDate}

                                nextLabel='>>'
                                nextAriaLabel={null}
                                next2Label={null}
                                prevLabel='<<'
                                prevAriaLabel={null}
                                prev2Label={null}
                                prev2AriaLabel={null}
                            />
                        </CalendarContainer>
                    </>

            }
        </>
    );
}
