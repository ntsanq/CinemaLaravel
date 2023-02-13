import React, {useState} from 'react';

export default function TimePick(props) {
    const [selectedTime, setSelectedTime] = useState("null");

    const timesData = props.timesData;

    const listItems = timesData.map((time, index) =>
        <button key={index}
                onClick={(e) => setSelectedTime(e.target.textContent)}
                style={{marginLeft: '20px'}}
        >{time.start}</button>
    );

    return (
        <>
            <h1 className='hi'>Time picker</h1>

            <h2>Please Select your preferred slot</h2>
            <div className="btns">

                <div className="grid-button">
                    <div style={{display: "flex"}}>{listItems}</div>
                </div>
            </div>


            <p>Current selected date is <b>{selectedTime}</b></p>

        </>
    );
}
