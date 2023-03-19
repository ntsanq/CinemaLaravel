import React, {useEffect, useState} from 'react';
import {createRoot} from "react-dom/client";
import FilmService from "../services/FilmService";
import Loading from "./Booking/Loading";

export default function WeeklyPost() {

    const [loading, setLoading] = useState(false);

    const [mostBookedFilm, setMostBookedFilm] = useState({});

    useEffect(() => {
        FilmService.getWeeklyFilm().then(r => {
            setLoading(true);
            setMostBookedFilm(r.data);
            setLoading(false);
        }).catch(e => {
            console.log(e);
        })
    }, [])

    if (loading) {
        return <Loading />;
    } else {
        return mostBookedFilm[0] ? (
            <ul className="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">
                <li className="uk-nav-header uk-margin-small-bottom">Weekly Movie</li>
                <li>
                    <a href={`/films/${mostBookedFilm.id}`}>
                        <img
                            className="uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-fade"
                            src={mostBookedFilm.path}
                            alt="weekly"
                        />
                        <span className="uk-margin-small-top">{mostBookedFilm.name}</span>
                    </a>
                </li>
                <li className="uk-nav-divider"></li>
            </ul>
        ) : null;
    }
}

if (document.getElementById('weekly_post')) {
    createRoot(document.getElementById('weekly_post')).render(<WeeklyPost/>);
}

