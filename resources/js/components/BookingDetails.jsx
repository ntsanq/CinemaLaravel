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
                <div className="uk-flex-bottom uk-margin-left">
                    <div className="uk-text-left uk-text-contrast booking-details--film-name">{film.name}</div>
                    <div className="uk-text-left booking-details--film-rules uk-margin-bottom ">
                        <span className="booking-details--film-rules">(*)</span>
                        {film.rules ? film.rules.map((item, i) => {
                            return (<span className="uk-text-left uk-margin-small-left" key={i}>{item}
                                {i !== film.rules.length - 1 && ','}
                        </span>)
                        }) : ''}
                    </div>

                    <div
                        className="uk-text-left uk-margin-small booking-details--film-categories uk-margin-small-bottom">
                        <span>Genre: </span>
                        {film.categories ? film.categories.map((item, i) => {
                            return (<span className="uk-text-left uk-text-contrast" key={i}>{item}
                                {i !== film.rules.length - 1 && ', '}
                            </span>)
                        }) : ''}
                    </div>

                    <div className="uk-text-left booking-details--film-production uk-margin-small-bottom">
                        <span>Production: {film.production}</span>
                    </div>

                    <div className="uk-text-left booking-details--film-description uk-margin-small-bottom">
                        <span>Description: {film.description}</span>
                    </div>


                </div>
            </div>

            <h3 className="uk-text-left uk-text-contrast uk-margin-small-bottom uk-text-bold">Ticket:</h3>
            <div className="booking-details--ticket-details">
                <div className="uk-text-left uk-margin-small">
                    <span style={{opacity: 0.7}}>Showtime: </span>
                    <span> {timeState.split(' ')[0] === 'null' ? '' : timeState.split(' ')[0]}</span>
                </div>
                <div className="uk-text-left uk-margin-small light">
                    <span style={{opacity: 0.7}}>Seat numbers: </span>
                    {seatInfos.map(seat => <span
                        key={`${seat.id}-${seat.name}`}>{seat.name} {" "}</span>)}</div>
                <div className="uk-text-left uk-margin-small wei">
                    <span style={{opacity: 0.7}}>Total prices:</span>
                    <span
                        className="uk-text-bold"> {seatInfos.reduce((total, seat) => total + seat.price, 0)} VND</span>
                </div>
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
                    <p>
                        <img className="booking-details--checkout-img" src={film.path} alt=""/>
                    </p>
                    <p>Showtime: {timeState.split(' ')[0]}</p>
                    <p>Seats: {seatInfos.map(seat => <span
                        key={`${seat.id}-${seat.name}`}>{seat.name} {" "}</span>)}</p>
                    <p>Total prices: {seatInfos.reduce((total, seat) => total + seat.price, 0)} VND</p>

                    <h3 className="payment-label">Payment method</h3>
                    <div>
                        <input type="radio" id="stripe" name="payment_method" value="stripe"
                               onChange={(e) => handlePayment(e.currentTarget.value)}></input>
                        <label htmlFor="stripe" style={{marginLeft: "7px"}}>
                            <img
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/ba/Stripe_Logo%2C_revised_2016.svg/1280px-Stripe_Logo%2C_revised_2016.svg.png"
                                alt="" width="60px"/>
                        </label>
                    </div>

                    <div className="uk-margin-top">
                        <input type="radio" id="momo" name="payment_method" value="momo"
                               onChange={(e) => handlePayment(e.currentTarget.value)}></input>
                        <label htmlFor="momo" style={{marginLeft: "10px"}}>
                            <img
                                src="https://cdn.haitrieu.com/wp-content/uploads/2022/10/Logo-MoMo-Transparent.png"
                                alt="" width="30px"/>
                        </label>
                    </div>
                </Modal>
            </div>
        </div>
    );
}
