import React, { useState} from 'react';
import {createRoot} from "react-dom/client";
import FilmService from "../services/FilmService";

export default function WeeklyPost() {

    const [mostBookedFilm, setMostBookedFilm] = useState({});

    FilmService.getWeeklyFilm().then(r => {
        setMostBookedFilm(r.data);
    }).catch(e => {
        console.log(e);
    });

    return (
        <>
            <ul className="uk-nav uk-nav-comments uk-nav-side" data-uk-nav="">
                <li className="uk-nav-header uk-margin-small-bottom">Weekly Movie</li>
                <li>
                    <a href={`/films/${mostBookedFilm.id}`}>
                        <img className="uk-scrollspy-init-inview uk-scrollspy-inview uk-animation-fade"
                             src={mostBookedFilm.path}/>
                        <span className="uk-margin-small-top">{mostBookedFilm.name}</span>
                    </a>
                </li>
                <li className="uk-nav-divider"></li>
            </ul>
        </>
    )
}

if (document.getElementById('weekly_post')) {
    createRoot(document.getElementById('weekly_post')).render(<WeeklyPost/>);
}

