import React, {useEffect, useState} from 'react';
import Calendar from "react-calendar";
// import 'react-calendar/dist/Calendar.css';
import moment from 'moment';
import Loading from "./Loading";

import styled from 'styled-components';

const CalendarContainer = styled.div`
    margin: 20px auto auto;
    background-color: #252527;
    padding: 20px 20px;
    max-height: 300px;
    width: 100%;
    border-radius: 6px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, .3);

    abbr[title] {
        text-decoration: none;
        border-bottom: none;
    }

    .react-calendar__navigation {
        display: flex;
        margin-bottom: 5px;

        .react-calendar__navigation__label {
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .react-calendar__navigation__arrow {
            flex-grow: 0.333;
        }
    }

    .react-calendar__month-view__weekdays {
        text-align: center;
        color: #9b9b9b;
    }

    button {
        margin: 3px;
        background-color: #252527;
        border: 0;
        border-radius: 3px;
        color: white;
        padding: 5px 0;
        cursor: pointer;

        &:hover {
            font-weight: bold;
            background-color: lightblue;
            color: #232323;
        }

        &:active {
            background-color: #a7a8a9;
        }
    }

    .react-calendar__month-view__days {
        display: grid !important;
        grid-template-columns: 14.2% 14.2% 14.2% 14.2% 14.2% 14.2% 14.2%;

        .react-calendar__tile {
            max-width: initial !important;
        }
    }

    .react-calendar__month-view__days__day--neighboringMonth {
        opacity: 0.3;
    }

    .react-calendar__month-view__days__day--weekend {
        color: #9d2626;
        box-shadow: none;
    }

    .react-calendar__tile--range {
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
        }, 500)
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
        <div className="date-pick uk-margin-large-bottom">
            <h2 className="uk-text-contrast">Choose date:</h2>
            {
                loading ? <Loading/> :
                    <CalendarContainer>
                        <Calendar
                            value={dateState}
                            onChange={changeDate}
                            nextLabel='>'
                            nextAriaLabel={null}
                            next2Label={null}
                            prevLabel='<'
                            prevAriaLabel={null}
                            prev2Label={null}
                            prev2AriaLabel={null}
                        />
                    </CalendarContainer>
            }
        </div>
    );
}
