import React, {useEffect, useState} from 'react';
import Loading from "./Loading";

export default function TimePick(props) {
    const [selectedTime, setSelectedTime] = useState("null");
    const [loading, setLoading] = useState(false)

    useEffect(() => {
        setLoading(true)
        setTimeout(() => {
            setLoading(false)
        }, 500)
    }, [props.timesData[0]])

    useEffect(() => {
        props.onData(selectedTime);
    }, [selectedTime])

    const listItems = props.timesData.map((time, index) =>
        <button key={index}
                onClick={handleButton}
                style={{marginLeft: '20px'}}
        >{time.start} <span hidden>{time.room_id}</span></button>
    );


    function handleButton(e) {
        setSelectedTime(e.target.textContent);
        const buttonContent = e.target.textContent.split(' ');
        const roomId = buttonContent[1];
        props.getSeats(roomId);
    }

    return (
        <>
            <h1>Choose time</h1>
            {
                loading ? <Loading/> :
                    <>
                        {
                            listItems[0] ?
                                <div className="grid-button">
                                    <div style={{display: "flex"}}>{listItems}</div>
                                </div> :
                                <div>Pick another date</div>
                        }
                    </>
            }
        </>
    );
}
