import React, {useEffect, useState} from 'react';
import Calendar from "react-calendar";
// import 'react-calendar/dist/Calendar.css';
import moment from 'moment';
import Loading from "./Loading";

import styled from 'styled-components';

export default function DatePick(props) {
    const getTimes = props.getTimes;
    const filmId = props.filmId;

    const [dateState, setDateState] = useState(new Date())
    const [loading, setLoading] = useState(true);


    useEffect(() => {
        setTimeout(() => {
            setLoading(false)
        }, 1000)
    }, [])

    useEffect(() => {
        getTimes(filmId, moment(dateState).format('DD-MM-YYYY'));
        props.onData(dateState);
    }, [dateState])

    const changeDate = (e) => {
        setDateState(e);
        props.onData(e);
    }

    const CalendarContainer = styled.div`
        /* ~~~ container styles ~~~ */
        margin: 20px auto auto;
        background-color: #252527;
        padding: 10px 10px;
        height: 210px;
        width: 50%;

        border-radius: 5px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .3);

        abbr[title] {
            text-decoration: none;
        }

        /* ~~~ navigation styles ~~~ */

        .react-calendar__navigation {
            display: flex;

            .react-calendar__navigation__label {
                font-weight: bold;
                color: red;
            }

            .react-calendar__navigation__arrow {
                flex-grow: 0.333;
            }
        }


        /* ~~~ label styles ~~~ */

        .react-calendar__month-view__weekdays {
            text-align: center;
            color: green;
        }

        button {
            margin: 3px;
            background-color: #6f876f;
            border: 0;
            border-radius: 3px;
            color: white;
            padding: 5px 0;

            &:hover {
                background-color: #18a518;
            }

            &:active {
                background-color: #412c06;
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
            opacity: 0.7;
        }

        .react-calendar__month-view__days__day--neighboringMonth {

        }

        .react-calendar__month-view__days__day--weekend {
            color: #9d2626;
        }

        /* ~~~ active day styles ~~~ */

        .react-calendar__tile--range {
            box-shadow: 0 0 6px 2px black;
            color: red;
            background-color: blue;
        }
    `;

    return (
        <>
            {
                loading ? <Loading/> :

                    <CalendarContainer>
                        <Calendar
                            value={dateState}
                            onChange={changeDate}

                            nextLabel='next month'
                            nextAriaLabel={null}
                            next2Label={null}
                            prevLabel='prev month'
                            prevAriaLabel={null}
                            prev2Label={null}
                            prev2AriaLabel={null}
                        />
                    </CalendarContainer>
            }
        </>
    );
}
