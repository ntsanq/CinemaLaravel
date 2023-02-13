import React, {useEffect, useState} from 'react';
import Calendar from "react-calendar";
import 'react-calendar/dist/Calendar.css';
import moment from 'moment';

export default function DatePick(props) {
    const getTimes = props.getTimes;
    const filmId = props.filmId;

    const [dateState, setDateState] = useState(new Date())

    useEffect(() => {
        getTimes(filmId, moment(dateState).format('DD-MM-YYYY'));
    },[dateState])

    const changeDate = (e) => {
        setDateState(e);
    }

    return (
        <>
            <Calendar
                value={dateState}
                onChange={changeDate}
            />
        </>
    );
}
