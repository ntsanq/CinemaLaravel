import React from "react";

export default function BookingDetails(props) {

    const film = props.film;
    const timeState = props.timeState;
    const seatInfos = props.seatInfos;
    const handlePopup = props.handlePopup;

    return (
        <>
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
        </>
    );
}

