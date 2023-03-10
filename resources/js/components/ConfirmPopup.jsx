import React from "react";

export default function ConfirmPopup(props) {
    const timeState = props.timeState;
    const seatInfos = props.seatInfos;
    const handlePayment = props.handlePayment;
    const handlePopup = props.handlePopup;
    const handleSubmitConfirm = props.handleSubmitConfirm;

    return (
        <>
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
        </>
    );
}
