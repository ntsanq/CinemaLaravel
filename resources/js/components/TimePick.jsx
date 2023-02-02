import React, {useState} from 'react';
import moment from "moment/moment";

export default function TimePick() {
    const [time, setTime] = useState("null");

    const timeData = ['08:20', '01:20', '13:20', '15:20'];
    const listItems = timeData.map((point) =>
        <button onClick={(e) => setTime(e.target.textContent)} style={{marginLeft: '20px'}}>{point}</button>
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


            <p>Current selected date is <b>{time}</b></p>

        </>
    );
}
