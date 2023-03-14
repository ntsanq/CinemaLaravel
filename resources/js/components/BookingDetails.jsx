import React, {useState} from "react";
import {Button, Modal} from "antd";

export default function BookingDetails(props) {
    const film = props.film;
    const timeState = props.timeState;
    const seatInfos = props.seatInfos;
    const handleEnoughInfo = props.handleEnoughInfo;
    const handleSubmitConfirm = props.handleSubmitConfirm;
    const open = props.popUpOpen;
    const setPopUp = props.onPopUpData;
    const handlePayment = props.handelPayment;
    const [loading, setLoading] = useState(false);

    const handleOk = () => {
        setLoading(true);
        setTimeout(() => {
            setLoading(false);
            setPopUp(false);
        }, 3000);
    };

    const handleCancel = () => {
        setPopUp(false);
    };


    return (
        <div className="uk-flex uk-flex-column">
            <div className="uk-flex uk-margin-bottom">
                <div className="uk-width-1-2 uk-overlay-background-blue uk-margin-bottom-remove booking-details--img">
                    <img src={film.path} alt="film image"></img>
                </div>
                <div className="uk-flex-bottom uk-margin-left booking-details--film-name">
                    <h2 className="uk-text-contrast">{film.name}</h2>

                    <div className="uk-text-left booking-details--film-rules">
                        <span className="" style={{color: "red"}}>(*)</span>
                        {film.rules ? film.rules.map((item, i) => {
                            return (<span className="uk-text-left uk-margin-small-left" key={i}>{item}
                                {i !== film.rules.length - 1 && ','}
                        </span>)
                        }) : '(*)'}
                    </div>

                    <div className="uk-text-left uk-margin-small booking-details--film-categories">
                        <span>Genre: </span>
                        {film.categories ? film.categories.map((item, i) => {
                            return (<span className="uk-text-left" key={i}>{item}
                                {i !== film.rules.length - 1 && ', '}
                            </span>)
                        }) : ''}
                    </div>

                    <div className="uk-text-left booking-details--film-production">
                        <span>Production: {film.production}</span>
                    </div>
                </div>
            </div>

            <h3 className="uk-text-left uk-text-contrast">Ticket:</h3>
            <div
                className="uk-text-left uk-margin-small">Showtime: {timeState.split(' ')[0] === 'null' ? '' : timeState.split(' ')[0]}
            </div>
            <div className="uk-text-left uk-margin-small">Seat numbers: {seatInfos.map(seat => <span
                key={`${seat.id}-${seat.name}`}>{seat.name} {" "}</span>)}</div>
            <div className="uk-text-left uk-margin-small">Total
                prices: {seatInfos.reduce((total, seat) => total + seat.price, 0)} VND
            </div>

            <hr/>

            <div>
                <Button className="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="primary"
                        onClick={() => {
                            handleEnoughInfo();
                        }}>
                    Confirm
                </Button>
                <Modal
                    open={open}
                    title="Confirm you booking information"
                    onOk={handleOk}
                    onCancel={handleCancel}
                    footer={[
                        <Button key="back" onClick={handleCancel}>
                            Cancel
                        </Button>,
                        <Button key="submit" type="primary" loading={loading} onClick={handleSubmitConfirm}>
                            Pay
                        </Button>,
                    ]}
                >
                    <p>showtime: {timeState.split(' ')[0]}</p>
                    <p>seats: {seatInfos.map(seat => <span
                        key={`${seat.id}-${seat.name}`}>{seat.name} {" "}</span>)}</p>
                    <p>number of tickets: {seatInfos.length}</p>
                    <p>prices: {seatInfos.reduce((total, seat) => total + seat.price, 0)}</p>

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
                </Modal>
            </div>
        </div>
    );
}
