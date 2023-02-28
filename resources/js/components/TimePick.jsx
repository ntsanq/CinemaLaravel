import React, {useEffect, useState} from 'react';

export default function TimePick(props) {
    const [selectedTime, setSelectedTime] = useState("null");

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
            <div className="grid-button">
                <div style={{display: "flex"}}>{listItems}</div>
            </div>
        </>
    );
}
