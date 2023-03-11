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
        <>
            <img src={film.path} className="" alt="film image"></img>
            <h2 className="uk-text-contrast">{film.name}</h2>
            <div>showtime: {timeState.split(' ')[0]}</div>
            <div>seats: {seatInfos.map(seat => <span
                key={`${seat.id}-${seat.name}`}>{seat.name} {" "}</span>)}</div>
            <span>number of tickets: {seatInfos.length}</span>{" "}
            <span>prices: {seatInfos.reduce((total, seat) => total + seat.price, 0)}</span>

            <hr/>

            <div>
                <Button  className="uk-width-1-1 uk-button uk-button-primary uk-button-large" type="primary" onClick={() => {
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
        </>
    );
}

